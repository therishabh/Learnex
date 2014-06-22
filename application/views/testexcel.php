<html>
<body>
<?php echo form_open_multipart('excel/read','id="student-form"');?>
  
  <table width="400">
  <tr>
  <td>Names file:</td>
  <td><input type="file" name="file" /></td>
  <td><input type="submit" value="Upload" /></td>
  </tr>
  </table>
  </form>
  </body>
  </html>