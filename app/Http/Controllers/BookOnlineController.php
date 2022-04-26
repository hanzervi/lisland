<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Book;
use App\Customer;
use App\Room;

use PHPMailer\PHPMailer;

class BookOnlineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $room = Room::where('status', '!=', '-1')
                    ->get();

        if (Auth::check()) {
            if (Auth::user()->booker_id == null)
                return view('admin.book-online.index', ['room' => $room]);
            else
                return redirect('/');
        }
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('books')
                        ->selectRaw('
                            DATE_FORMAT(books.created_at, "%y%m%d%H%i") as ref, books.id, rooms.name as room,
                            CONCAT(customers.firstname, " ", customers.lastname) as customer,
                            books.adults, books.children, books.infants, books.add_person,
                            books.check_in, books.check_out, books.priceTotal, books.status, books.remarks,
                            books.payment, books.payment_ref
                        ')
                        ->join('rooms', 'rooms.id', '=', 'books.room_id')
                        ->join('customers', 'customers.id', '=', 'books.customer_id')
                        ->where('books.status', '!=', '-1')
                        ->where('books.type', '=', 'online')
                        ->get();

            foreach($data as $item) {
                $item->pax = $item->adults + ($item->children = null ? 0 : $item->children) + ($item->infants = null ? 0 : $item->infants) + ($item->add_person = null ? 0 : $item->add_person);
            }

            return $data;
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function get(Request $request, $id) {
        if ($request->ajax()) {
            $data = DB::table('books')
                        ->selectRaw('
                            books.id, rooms.name as room,
                            books.adults, books.children, books.infants, books.add_person, books.check_in, books.check_out,
                            customers.firstname, customers.lastname, customers.address, customers.sex, customers.contact_no, customers.email,
                            books.remarks, books.payment, books.payment_ref
                        ')
                        ->join('rooms', 'rooms.id', '=', 'books.room_id')
                        ->join('customers', 'customers.id', '=', 'books.customer_id')
                        ->where('books.id', '=', $id)
                        ->get();

            return $data;
        }
        
        return response()->json(['error' => 'Unauthorized.'], 401);
    }

    public function countPending() {
        return Book::where('type', '=', 'online')
                    ->where('status', '=', 0)
                    ->count();
    }

    public function updateStatus($id, $status) {
        try {
            
            $book = Book::find($id);
            $customer = Customer::find($book->customer_id);
            $room = Room::find($book->room_id);

            if ($status == 1) {
                $body = "Dear Sir/Madam ".$customer->lastname.", <br>
                            Good Day! <br><br>

                            Reference: <b>".date_format(date_create($book->created_at), 'ymdHi')."</b> <br><br>

                            <div style='color: green;'>YOUR RESERVATION BOOK STATUS IS NOW <b>RESERVED</b>.</div> <br><br>

                            The following are the details of your booking: <br>
                            <hr>
                            Paid Thru: <b> ".$book->payment."</b> <br>
                            Payment Ref #: <b> ".$book->payment_ref."</b> <br>
                            Room: <b> ".$room->name."</b> <br>
                            Check-in Date: <b>".date_format(date_create($book->check_in), 'M d, Y')."</b> <br>
                            Check-out Date: <b>".date_format(date_create($book->check_out), 'M d, Y')."</b> <br>
                            Total Price: <b>".number_format($book->priceTotal, 2)."</b>
                            <hr>

                            <br><br><br> - Lisland Management Team";

                $mail               = new PHPMailer\PHPMailer();
                
                //$mail->SMTPDebug    = 1;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pccartel.computers@gmail.com';
                $mail->Password = 'admincartel';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->SetFrom("pccartel.computers@gmail.com", "Lisland Management Team");

                $mail->addAddress($customer->email);

                $mail->isHTML(true);
                $mail->Subject = "Lisland Reservation Book Status";
                $mail->Body    = $body;
                $mail->send();

                /* sms ----------------- */

                $apicode = "TR-MARCO937024_2B18Y";
                $passwd = 'b$ti@$u(a3';
                $number = $customer->contact_no;
                $message = "Dear Sir/Madam" . $customer->lastname . ", Your reservation book status is now RESERVED. - By Lisland Management Team.";

                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
                $param = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($itexmo),
                    ),
                );
                $context  = stream_context_create($param);
                file_get_contents($url, false, $context);
            }
            else if ($status == -1) {
                $body = "Dear Sir/Madam ".$customer->lastname.", <br>
                            Good Day! <br><br>

                            Reference: <b>".date_format(date_create($book->created_at), 'ymdHi')."</b> <br><br>

                            <div style='color: red;'>YOUR RESERVATION BOOK STATUS HAS BEEN <b>CANCELLED</b>.</div> <br><br>

                            The following are the details of your booking: <br>
                            <hr>
                            Paid Thru: <b> ".$book->payment."</b> <br>
                            Payment Ref #: <b> ".$book->payment_ref."</b> <br>
                            Room: <b> ".$room->name."</b> <br>
                            Check-in Date: <b>".date_format(date_create($book->check_in), 'M d, Y')."</b> <br>
                            Check-out Date: <b>".date_format(date_create($book->check_out), 'M d, Y')."</b> <br>
                            Total Price: <b>".number_format($book->priceTotal, 2)."</b>
                            <hr>

                            <br><br><br> - Lisland Management Team";

                $mail               = new PHPMailer\PHPMailer();
                
                //$mail->SMTPDebug    = 1;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'pccartel.computers@gmail.com';
                $mail->Password = 'admincartel';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->SetFrom("pccartel.computers@gmail.com", "Lisland Management Team");

                /* $mail->Username = 'lislandresortph@gmail.com';
                $mail->Password = 'mjbalangue611';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->SetFrom("lislandresortph@gmail.com", "Lisland Management Team"); */

                $mail->addAddress($customer->email);

                $mail->isHTML(true);
                $mail->Subject = "Lisland Reservation Book Status";
                $mail->Body    = $body;
                $mail->send();

                /* sms ----------------- */

                $apicode = "TR-MARCO937024_2B18Y";
                $passwd = 'b$ti@$u(a3';
                $number = $customer->contact_no;
                $message = "Dear Sir/Madam" . $customer->lastname . ", Your reservation book status has been CANCELLED. - By Lisland Management Team.";

                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
                $param = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($itexmo),
                    ),
                );
                $context  = stream_context_create($param);
                file_get_contents($url, false, $context);
            }

            Book::whereId($id)
            ->update(['status' => $status]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request) {
        try {
            $book = Book::whereId($request->update_id)
                        ->first();

            $add = $request->update_add_person - $book->add_person;

            Book::whereId($request->update_id)
                ->update([
                    'adults' => $request->update_adults,
                    'children' => $request->update_children,
                    'infants' => $request->update_infants,
                    'add_person' => $request->update_add_person,
                    'priceTotal' => $book->priceTotal + ($add * 750),
                    'remarks' => $request->update_remarks,
                    'payment' => $request->update_payment,
                    'payment_ref' => $request->update_payment_ref
                ]);

            return 'success';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
