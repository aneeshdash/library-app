<html>
<head>
    <title>Table Time</title>
    <style>
        table {
            background-color: transparent;
        }
        th {
            text-align: left;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border: 1px solid #ddd;
        }


        .table > tbody + tbody {
            border-top: 2px solid #ddd;
        }
        .table .table {
            background-color: #fff;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
        .table-bordered {
            border: 1px solid black;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid black;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }
    </style>
</head>

<body>

<table class="table table-bordered">
    <thead>
    <tr>
        <th colspan="2" style="text-align:center;">Lost Book Invoice</th>
    </tr>

    </thead>
    <tbody>
    <tr>
        <td><strong>Name</strong></td>
        <td width="80%">{{$name}}</td>
    </tr>

    <tr>
        <td><strong>Roll No</strong></td>
        <td>{{$roll}}</td>
    </tr>

    <tr>
        <td><strong>Book Title</strong></td>
        <td>{{$book}}</td>
    </tr>
    <tr>
        <td><strong>Authors</strong></td>
        <td>{{$authors}}</td>
    </tr>
    <tr>
        <td><strong>Publication</strong></td>
        <td>{{$publication}}</td>
    </tr>
    <tr>
        <td><strong>ISBN</strong></td>
        <td>{{$ISBN}}</td>
    </tr>
    </tbody>
</table>

<p style="margin-left:460px;"><strong>Signature of the Librarian</strong></p>

</body>

</html>