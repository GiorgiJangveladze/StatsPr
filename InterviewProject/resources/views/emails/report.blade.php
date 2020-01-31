<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>

  <style type="text/css">
      @import "compass/css3";
      @import 'https://fonts.googleapis.com/css?family=Montserrat:300,400,700';
       .rwd-table {
         margin: 1em 0;
         min-width: 300px;
      }
       .rwd-table tr {
         border-top: 1px solid #ddd;
         border-bottom: 1px solid #ddd;
      }
       .rwd-table th {
         display: none;
      }
       .rwd-table td {
         display: block;
      }
       .rwd-table td:first-child {
         padding-top: 0.5em;
      }
       .rwd-table td:last-child {
         padding-bottom: 0.5em;
      }
       .rwd-table td:before {
         content: attr(data-th) ": ";
         font-weight: bold;
         width: 6.5em;
         display: inline-block;
      }
       @media (min-width: 480px) {
         .rwd-table td:before {
           display: none;
        }
      }
       .rwd-table th, .rwd-table td {
         text-align: left;
      }
       @media (min-width: 480px) {
         .rwd-table th, .rwd-table td {
           display: table-cell;
           padding: 0.25em 0.5em;
        }
         .rwd-table th:first-child, .rwd-table td:first-child {
           padding-left: 0;
        }
         .rwd-table th:last-child, .rwd-table td:last-child {
           padding-right: 0;
        }
      }
       body {
         padding: 0 2em;
         font-family: Montserrat, sans-serif;
         -webkit-font-smoothing: antialiased;
         text-rendering: optimizeLegibility;
         color: #444;
         background: #eee;
      }
       h1 {
         font-weight: normal;
         letter-spacing: -1px;
         color: #34495e;
      }
       .rwd-table {
         background: #34495e;
         color: #fff;
         border-radius: 0.4em;
         overflow: hidden;
      }
       .rwd-table tr {
         border-color: #46637f;
      }
       .rwd-table th, .rwd-table td {
         margin: 0.5em 1em;
      }
       @media (min-width: 480px) {
         .rwd-table th, .rwd-table td {
           padding: 1em !important;
        }
      }
       .rwd-table th, .rwd-table td:before {
         color: #dd5;
      }
  </style>
</head>
<body style="margin:0; padding:0; background-color:#F2F2F2;">
  <center>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="rwd-table" bgcolor="#F2F2F2">
         <tr>
                <th align="center" valign="top"> Client</th>
                <th align="center" valign="top"> Product</th>
                <th align="center" valign="top"> Total</th>
                <th align="center" valign="top" >Date</th>
            </tr>
        <tr>
            @foreach($products as $product)
            <tr>
                <td align="center" valign="top">{{$product['client']['name']}}</td>
                <td align="center" valign="top">{{$product['product']}}</td>
                <td align="center" valign="top">{{$product['total']}}</td>
                <td align="center" valign="top">{{ date('d/m/Y', strtotime($product['date'])) }}</td>
            </tr>
            @endforeach
        </tr>
    </table>
  </center>
</body>
</html>
