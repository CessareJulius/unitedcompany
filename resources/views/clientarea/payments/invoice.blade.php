@extends('app.clientarea')

@section('contenido')

    <div class="rowd">
        <h3 class="text-center">Confirmación de pago</h3>


        <table class="table table-bordered">
           
            <tbody>
                <tr>
                    <td>Razón de pago:</td>
                    <td>{{session('pago')['razon_pago']}}</td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>{{session('pago')['total']}}S/.</td>
                </tr>
            </tbody>


            
        </table>
        <div class="pull-right">
                <a href="{{action('clientarea\paymentController@create')}}" class="btn btn-primary" >Confirmar Pago</a>
        </div>
    </div>


    <style>
        .table tbody tr td:nth-child(2) {
            text-align: right;
        }
        .table tbody tr td {
            font-weight: bold;
        }
    </style>
@endsection