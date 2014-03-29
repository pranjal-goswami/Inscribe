<?
/**
 * © 2013-2015 GreekTurtle
 *
 * LICENSE:
 *
 * This file is part of Inscribe (http://inscribe.io).
 *
 * The contents of this file cannot be copied, distributed or modified without prior
 * consent from the author. 
 *
 * Project : Inscribe
 * File : /_lib/model/class.Category.php
 * Description : Model for Post Category
 *
 * @author Naman Agrawal <naman[at]weblength[dot]co[dot]in> 
 * @author Pranjal Goswami <pranjal[at]weblength[dot]co[dot]in> 
 * 
 * BADesigns | GreekTurtle | Weblength Infonet Pvt. Ltd. 
 *
 * Created : Wed Jan 29 2014 20:04:33 GMT+0530 (IST)
 */

 class Category {
 	/**
	 * @var int   Internal Unique ID of category 
	 */
	var $id;
	/**
	 * @var Name of the category 
	 */
	var $category_name;

	/* Class Constructor */
    public function __construct($row = false) {
        if ($row) {
        	$this->id = $row['id'];
			$this->category_name = $row['category_name'];
        }
    }
 }