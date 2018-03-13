// NOTE!!!!  If you make changes to this file, and your menu "disappears",
// it means you probably have a typo in the code HERE.  
// A popular mistake has been mismatched quotes.   Look carefully!


// 1. transparancy of the items
// 2. left position of the whole menu
// 3. height position of the whole menu
// 4. width of the head items of the menu
// 5. top of the head items of the menu
// 6. space between the head items
// 7. width of the border of the head items
// 8. bordercolor of the head items
// 9. 1 to set the head items bold , 1 to set the head items normal
// 10. font-size of the head items
// 11. font-family of the head items
// 12. border style of the head items
// 13. space between the header and the items
// 14. width of the items
// 15. heigth of the items
// 16. width of the border items
// 17. color of the item border
// 18. border style of the items
// 19. font size of the items
// 20. font-family of the items
// 21. space between the item panels (multi-level)
// 22. left padding in the head item block
// 23. top padding in the head item block
// 24. icon at the left when there are subitems

//link ==> [text,url,target,text_color,background_color,
//				text_color_onmouseover,background_color_onmouseover]
//link with items ==> [text,url,target,text_color,background_color,
//				text_color_onmouseover,background_color_onmouseover,[items]] 

  LeftMenuProps = [95,0,-3,158,22,-1,1,'#bbcbdb',1,13,'Arial', 
				'solid', -15,155,28,1,'#000000','solid',11,'Arial',-1,3,1,''];

  LeftMenuLinks =[

  	['Browse Departments',null,'','white','black','white','black'],
	
	['Bike','/products.php?PageID=100','','black','white','black','#EAEFF4',
			   [
			   	['Road','/products.php?PageID=100','_self','#000000','#ffffff','#000000','#bbcbdb'],

				['MTB','/products.php?PageID=101', '_self', '#000000', '#ffffff', '#000000', '#bbcbdb'],

				['City','/products.php?PageID=102','_self','#000000','#ffffff','#000000','#bbcbdb']

			   ]
	],
	
	['Clothing','/products.php?PageID=200','','black','white','black','#EAEFF4',
			   [
			   	['Jacket','/products.php?PageID=200','_self','#000000','#ffffff','#000000','#bbcbdb'],

				['Pants','/products.php?PageID=201', '_self', '#000000', '#ffffff', '#000000', '#bbcbdb'],

				['Cap','/products.php?PageID=202','_self','#000000','#ffffff','#000000','#bbcbdb']

			   ]
	],
	
	['Equipment','/products.php?PageID=300','','black','white','black','#EAEFF4',
			   [
			   	['Helmet','/products.php?PageID=300','_self','#000000','#ffffff','#000000','#bbcbdb'],

				['Eyewear','/products.php?PageID=301', '_self', '#000000', '#ffffff', '#000000', '#bbcbdb'],

				['Lights','/products.php?PageID=302','_self','#000000','#ffffff','#000000','#bbcbdb']

			   ]
	],
	
	['Language Translators','../LanguageTrans/index.php','','black','white','black','#EAEFF4',
			   [
			   	['Spanish - English','../LanguageTrans/index.php','_self','#000000','#ffffff','#000000','#bbcbdb'],

				['French - English','../LanguageTrans/FrenchEnglish.php', '_self', '#000000', '#ffffff', '#000000', '#bbcbdb'],

				['German - English','../LanguageTrans/GermanEnglish.php','_self','#000000','#ffffff','#000000','#bbcbdb']

			   ]
	],
	
	['Course Demos','../Demos/index.php','','white','blue','black','#EAEFF4'],
	
	// For now, this link does nothing.
	['Closeout Specials','.','','white','red','black','#EAEFF4']
	
	
	
];

//window.onload = correctsize;
//window.onresize = correctsize;
//window.onresize = fresh;