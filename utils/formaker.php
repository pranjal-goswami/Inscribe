<?
include "../db.php";

$sql = "SELECT * from profiles";
$result = mysql_query($sql);
/*
while ($property = mysql_fetch_field($result))
  {
  echo "Field name: " . $property->name . "<br />";
  echo "Table name: " . $property->table . "<br />";
  echo "Default value: " . $property->def . "<br />";
  echo "Max length: " . $property->max_length . "<br />";
  echo "Not NULL: " . $property->not_null . "<br />";
  echo "Primary Key: " . $property->primary_key . "<br />";
  echo "Unique Key: " . $property->unique_key . "<br />";
  echo "Mutliple Key: " . $property->multiple_key . "<br />";
  echo "Numeric Field: " . $property->numeric . "<br />";
  echo "BLOB: " . $property->blob . "<br />";
  echo "Field Type: " . $property->type . "<br />";
  echo "Unsigned: " . $property->unsigned . "<br />";
  echo "Zero-filled: " . $property->zerofill . "<br /><br />";
  }
  */
$result = mysql_query($sql);
echo 'INSERT INTO < tablename > ( ';

while($field = mysql_fetch_field($result))
{
	echo $field->name.', ';
}
echo ') VALUES (';
$result = mysql_query($sql);

while($field = mysql_fetch_field($result))
{
	echo '\'".$_POST[\''.$field->name.'\']."\', ';
}

echo '<br/><br/>';
$result = mysql_query($sql);
echo 'UPDATE < tablename >  SET ';

while($field = mysql_fetch_field($result))
{
	echo $field->name.' = \'".$_POST[\''.$field->name.'\']."\', ';
}


?>
*********************************************************************************
<? 
$result = mysql_query($sql);
while($field = mysql_fetch_field($result))
{
	echo ''.$field->name.', ';
}
echo '<br><br>';
$result = mysql_query($sql);
while($field = mysql_fetch_field($result))
{
	echo ':'.$field->name.', ';
}


echo '<br><br>';
$result = mysql_query($sql);
while($field = mysql_fetch_field($result))
{
	echo '\':'.$field->name.'\'=>$profile->'.$field->name.',<br/> ';
}


?>
<?
$result = mysql_query($sql);
?>
<xmp>
<?

while($property = mysql_fetch_field($result))
{
	//echo $property->type;
	/*
echo ('
 <div class="control-group">  
            <label class="control-label" for="'.$property->name.'">'.ucwords(str_replace("_"," ",$property->name)).'</label>  
            <div class="controls">  
              <input required type="text" class="input-xlarge'.(($property->type=='date')?' datepicker':'').'" id="'.$property->name.'" name="'.$property->name.'" value="<? echo $mi->'.$property->name.'==\'\'?\'0\':$mi->'.$property->name.' ?>" > 
            </div>  
          </div> 
		  ');
		  
		  */
}
mysql_select_db('information_schema');

$q = "SELECT COLUMN_NAME, COLUMN_COMMENT, DATA_TYPE from information_schema.COLUMNS WHERE TABLE_NAME='bond_details'";
$sql = mysql_query($q) or die(mysql_error());

while($field = mysql_fetch_object($sql))
{
	?>
	/**
	 * @var <? echo $field->DATA_TYPE.'   '.$field->COLUMN_COMMENT; ?> 
	 */
	<?
	echo 'var $'.$field->COLUMN_NAME.';'.PHP_EOL;
}

$sql = mysql_query($q) or die(mysql_error());

while($field = mysql_fetch_object($sql))
{
	echo '$this->'.$field->COLUMN_NAME.' = $row[\''.$field->COLUMN_NAME.'\'];'.PHP_EOL;
}
?>
?>
</xmp>
<?  echo dirname(__FILE__); ?>

