<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Score</title>
  <link rel="stylesheet" type="text/css" href="updatescore.css">
</head>
<body style="background-color: #E6E6FA">
<div>
  <div id="container1" class="container">
    <br><p style="font-style: bold;">TEAM X</p><br>
    <table>
      <thead>
        <tr id="header">
          <th>Batsman</th>
          <th>Status</th>
          <th>Fours</th>
          <th>Sixes</th>
          <th>Runs</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>KL Rahul</td>
          <td>
            <select>
              <option value=" ">Select</option>
              <option value="out">Out</option>
              <option value="not out">Not Out</option>
              <option value="yet to bat">Yet to Bat</option>
            </select>
          </td>
          <td>8</td>
          <td>4</td>
          <td>99</td>
        </tr>
        <tr>
          <td>Virat Kohli</td>
          <td>
            <select>
              <option value=" ">Select</option>
              <option value="out">Out</option>
              <option value="not out">Not Out</option>
              <option value="yet to bat">Yet to Bat</option>
            </select>
          </td>
          <td>6</td>
          <td>2</td>
          <td>88</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="container2" class="container">
    <br><p style="font-style: bold;">TEAM Y</p><br>
    <table>
      <thead>
        <tr id="header">
          <th>Bowlers</th>
          <th>Overs</th>
          <th>Runs</th>
          <th>Wickets</th>
          <th>Extras</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Mitchell Starc</td>
          <td>3.3</td>
          <td>12</td>
          <td>2</td>
          <td>4</td>
        </tr>
        <tr>
          <td>Adam Zampa</td>
          <td>5</td>
          <td>20</td>
          <td>0</td>
          <td>1</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="input_field1">
    <input type="submit" name="update" value="Update" class="btn" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>
  </div>

  <div class="input_field2">
    <input type="submit" name="2nd_inn" value="2nd Innings" class="btn" style="background: linear-gradient(-135deg, #000a02de, #1e7e34)";>
  </div>

  <h6>Runs : _______    Wickets : _______    Overs : _______</h6><br>
</div>
</body> 
</html>