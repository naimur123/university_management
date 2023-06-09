<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Download</title>
  <style>
        
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
 </style>
</head>
<body>
  <h1 class="text-center">Student List</h1>
  <table>
    <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Father Name</th>
          <th>Mother Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>DOB</th>
          <th>Department</th>
          <th>Credit completed</th>
        </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      @foreach($downloads as $report)
      <tr class="text-center">
        <th>{{ $i++ }}</th>
        <td>{{ $report->first_name . ' ' . $report->last_name }}</td>
        <td>{{ $report->father_name ?? "N/A" }}</td>
        <td>{{ $report->mother_name ?? "N/A" }}</td>
        <td>{{ $report->email ?? "N/A" }}</td>
        <td>{{ $report->mobile ?? "N/A" }}</td>
        <td>{{ $report->dob ?? "N/A" }}</td>
        <td>{{ $report->department->curriculum_short_name ?? "N/A" }}</td>
        <td>{{ $report['credit'] ?? "N/A" }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>



