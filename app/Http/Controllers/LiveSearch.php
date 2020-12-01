<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearch extends Controller
{
    function index()
    {
        $today = date('d/m/Y');
        $query = DB::table('orders')->where('day', '=', $today)->get()->toArray();
        $count = count($query);

        return view('Orders.list', compact('count'));
    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('orders')
                    ->where('id', 'like', '%'.$query.'%')
                    ->orWhere('day', 'like', '%'.$query.'%')
                    ->orWhere('clientName', 'like', '%'.$query.'%')
                    ->orWhere('deliverWay', 'like', '%'.$query.'%')
                    ->orWhere('payingMethod', 'like', '%'.$query.'%')
                    ->orWhere('status', 'like', '%'.$query.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(8);

            }elseif ($query == ''){
                $data = DB::table('orders')->paginate(8);
            }
            else
            {
                $data = DB::table('orders')
                    ->orderBy('CustomerID', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$row->id.'</td>
         <td>'.$row->day.'</td>
         <td>'.$row->clientName.'</td>
         <td>'.$row->deliverWay.'</td>
         <td>'.$row->payingMethod.'</td>
         <td>'.$row->status.'</td>
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="6">Sem registros encontrados.</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
