<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <title>Download</title>
  <style>
    @page {
      size: A4;
      margin: 0;
    }
        
    table {
        width: 100%;
        border-collapse: collapse;
    }
        
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    
    th {
        background-color: #f2f2f2;
    }
    
    .total-count {
        text-align: right;
        margin-right: 20px;
    }
 </style>
</head>
<body>
  <h1 class="text-center">Student List</h1>
  <table>
    <thead>
        <tr>
          <th style="width: 10%">Student ID</th>
          <th style="width: 15%">Name</th>
          <th style="width: 10%">Email</th>
          <th style="width: 15%">Mobile</th>
          <th style="width: 5%">Department</th>
          <th style="width: 2%">Credit completed</th>
        </tr>
    </thead>
    <tbody>
      @foreach($downloads as $report)
      <tr class="text-center">
        <td>{{ $report->user_id }}</td>
        <td>{{ $report->first_name . ' ' . $report->last_name }}</td>
        <td>{{ $report->email ?? "N/A" }}</td>
        <td>{{ $report->mobile ?? "N/A" }}</td>
        <td>{{ strtoupper($report->department->curriculum_short_name) ?? "N/A" }}</td>
        <td>{{ $report->credit ?? "0" }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <h4 class="total-count">Total Student: {{ $downloads->count() }}</h4>
</body>
</html>
