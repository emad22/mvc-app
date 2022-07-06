<style type="text/css">
    /*
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/CascadeStyleSheet.css to edit this template
*/
/* 
    Created on : Jun 12, 2022, 10:58:04 AM
    Author     : emadr
*/

body{
    font-family: Arial, Helvetica, sans-serif;
    margin: 0 auto;
}
*{
    box-sizing: border-box;
}

input[type=text], input[type=number], textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #44a5f0;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}


</style>
<div class="container">
            <h1> Fill To Edit</h1>
            <form action="" method="post" >
               <label > </label> <br>
              <label for="name"> Name</label>
              <input type="text" id="name" name="name" placeholder="Your name.." required="required" value="<?= $employee->name; ?> ">

              <label for="age">Age</label>
              <input type="number" id="age" name="age" placeholder="Your age.." min="22" max="99" required="required" value="<?= $employee->age; ?>">

              <label for="address">Address</label>
              <input type="text" id="address" name="address" placeholder="Your address.." required="required" value="<?= $employee->address; ?>">
              
              <label for="salary">Salary</label>
              <input type="number" id="salary" name="salary" step="0.01" placeholder="Your salary.." required="required"  value="<?= $employee->salary; ?>">

              <label for="tax">Tax</label>
              <input type="number" id="tax" name="tax" placeholder="Your tax.." step="0.01" min="1" max="5" required="required" value="<?= $employee->tax; ?>">

              <input type="submit" value="Update" name="submit">

            </form>
            
            
</div>
