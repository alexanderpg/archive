
// Объект языка версия 1.0
lang = new Object();
num_txt=0;
num_btn=0;
num_img=0;
error=0;
lang.title = function(txt){// Смена заголовка
             document.title = txt;
             }
lang.txt = function(txt){// Смена текста
            var obj = document.getElementsByName("txtLang");
			if(obj[num_txt]){
            obj[num_txt].innerHTML = txt;
            num_txt++;
			}}
lang.btn = function(txt){// Смена кнопки
            var obj = document.getElementsByName("btnLang");
			if(obj[num_btn]){
            obj[num_btn].value = txt;
            num_btn++;
            }}
lang.img = function(txt){// Смена альты картинки
            var obj = document.getElementsByName("imgLang");
			if(obj[num_img]){
            obj[num_img].alt = txt;
            num_img++;
            }}
lang.clean = function(){// Очищаем переменные
            num_txt=0;
            num_btn=0;
            num_img=0;
            }

message1="Attention! \nGiven operation can lead to loss items.\nyou really wish to execute the given command?";

message2="Attention! \nGiven operation can lead to loss bazy.\nyou really wish to execute the given command?"

// Смена языка
function DoCheckLang(file,enabled){

if(enabled == 1){

try{
  switch(file){

     case("/phpshop/admpanel/order/adm_visitorID.php"):
	 document.title="Editing of the order";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "Order";
	 txtLang[1].innerHTML = "Condition of the order";
	 txtLang[2].innerHTML = "Main";
	 txtLang[3].innerHTML = "Condition of the order";
	 txtLang[4].innerHTML = "Additional information ";
	 txtLang[5].innerHTML = "Buyer"; 
	 txtLang[6].innerHTML = "Address of delivery"; 
	 txtLang[7].innerHTML = "Time of delivery from"; 
	 txtLang[8].innerHTML = "up to"; 
	 txtLang[9].innerHTML = "Phone"; 
	 txtLang[10].innerHTML = "Payment"; 
	 txtLang[11].innerHTML = "The company"; 
	 txtLang[12].innerHTML = "Documents"; 
	 txtLang[13].innerHTML = "User"; 
	 txtLang[14].innerHTML = "Form of the order";
	 txtLang[15].innerHTML = "Order Forma";
	 txtLang[16].innerHTML = "Article";
	 txtLang[17].innerHTML = "Name";
	 txtLang[18].innerHTML = "Quantity";
	 txtLang[19].innerHTML = "Sum";
	 txtLang[20].innerHTML = "Total in view of the discount";
	 txtLang[21].innerHTML = "Pieces";
	 txtLang[22].innerHTML = "To add in the order";
	 txtLang[23].innerHTML = "ID of the goods";
	 document.getElementById("btnAdd").value = "Add";
	 txtLang[24].innerHTML = "Discount";
	 document.getElementById("btnChange").value = "Change";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnRemove").value = "Remove";
	 document.getElementById("btnCancel").value = "Cancel";
	 break;
	 
	 case("/phpshop/admpanel/order/adm_order_productID.php"):
	 document.title="Editing of the order";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Image";
	 txtLang[2].innerHTML = "Quantity";
	 txtLang[3].innerHTML = "Price";
	 txtLang[4].innerHTML = "Sum";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnRemove").value = "Remove";
	 document.getElementById("btnCancel").value = "Cancel";
	 break;
	 
	 case("/phpshop/admpanel/order/adm_order_deliveryID.php"):
	 document.title="Editing of delivery ";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "City of delivery ";
	 txtLang[1].innerHTML = "Sum";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnCancel").value = "Cancel";
	 break;
     
	 case("/phpshop/admpanel/catalog/admin_cat_content.php"):
	 if(document.getElementById("txtLang")){
	 var txtLang = document.getElementsByName("txtLang");
	 var imgLang = document.getElementsByName("imgLang");
	 txtLang[0].innerHTML = "Conclusion";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Price";
	 imgLang[0].alt="Available";
	 imgLang[1].alt="No";
	 imgLang[2].alt="Special offer";
	 imgLang[3].alt="YML Price";
     imgLang[4].alt="Novelty";
	 }
	 break;

     case("/phpshop/admpanel/catalog/adm_catalogID.php"):
	 lang.title("Category editing");
     lang.txt("Category editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Description");
	  lang.txt("Characteristics");
	 lang.txt("Headings");
	 lang.txt("Name");
	 lang.txt("Category");
	 lang.txt("Sorting");
	 lang.txt("Transition");
	 lang.txt("Positions on page");
	 lang.txt("Unloading");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.txt("Name for Rambler-purchase");
	 lang.txt("At filling weeding a category of the commodity offer it is necessary to use Names from the list of categories of platform Pokupki.rambler.ru");
     lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Autoselection");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;

     case("/phpshop/admpanel/catalog/adm_catalog_new.php"):
	 lang.title("New category");
     lang.txt("New category");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Description");
	  lang.txt("Characteristics");
	 lang.txt("Headings");
	 lang.txt("Name");
	 lang.txt("Category");
	 lang.txt("Sorting");
	 lang.txt("Transition");
	 lang.txt("Positions on page");
	 lang.txt("Unloading");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.txt("Name for Rambler-purchase");
	 lang.txt("At filling weeding a category of the commodity offer it is necessary to use Names from the list of categories of platform Pokupki.rambler.ru");
     lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Autoselection");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_product_new.php"):
	 lang.title("Creation of the new goods");
	 lang.txt("Creation of the new goods");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Images");
     lang.txt("Content");
	 lang.txt("Description");
	 lang.txt("Articles");
	 lang.txt("Headers");
	 lang.txt("Characteristics");
	 lang.txt("Subtypes");
	 lang.txt("Category");
	 lang.txt("Price");
	 lang.txt("Adjust");
	 lang.txt("Article");
	 lang.txt("Conclusion");
	 lang.txt("Adjust");
	 lang.txt("YML price");
	 lang.txt("Adjust");
	 lang.txt("Name");
	 lang.txt("Joint sale");
	 lang.txt("Enter identifiers (ID) the goods through a comma");
	 lang.txt("");
	 lang.txt("Small");
	 lang.txt("Big");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Subtypes of the goods");
	 lang.txt("Enter identifiers (ID) the goods through a comma");
	 lang.txt("Communications");
	 lang.txt("Usual goods");
	 lang.txt("Additional option for the leading goods");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Product");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Product");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Product");
	 lang.btn("General");
	 lang.btn("Auto");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel"); 
	 lang.btn("Reset");
	 lang.btn("Cancel"); 
	 
	 break;
	 
	 case("/phpshop/admpanel/product/adm_productID.php"):
	 lang.title("Creation of the new goods");
	 lang.txt("Creation of the new goods");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Images");
     lang.txt("Content");
	 lang.txt("Description");
	 lang.txt("Articles");
	 lang.txt("Headers");
	 lang.txt("Characteristics");
	 lang.txt("Subtypes");
	 lang.txt("Category");
	 lang.txt("Price");
	 lang.txt("Adjust");
	 lang.txt("Article");
	 lang.txt("Conclusion");
	 lang.txt("Adjust");
	 lang.txt("YML price");
	 lang.txt("Adjust");
	 lang.txt("Name");
	 lang.txt("Joint sale");
	 lang.txt("Enter identifiers (ID) the goods through a comma");
	 lang.txt("Scheme");
	 lang.txt("Warehouse");
	 lang.txt("Small");
	 lang.txt("Big");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
	 lang.txt("Automatic generation");
	 lang.txt("My template");
	 lang.txt("Manual adjustment");
     lang.txt("Tabular record for loading through Excel");
	 lang.txt("Subtypes of the goods");
	 lang.txt("Enter identifiers (ID) the goods through a comma");
	 lang.txt("Communications");
	 lang.txt("Usual goods");
	 lang.txt("Additional option for the leading goods");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Product");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Product");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Product");
	 lang.btn("General");
	 lang.btn("Auto");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Cancel");
	 lang.btn("Copy");
	 lang.btn("Reset");
	 lang.btn("Cancel"); 
	 break;
	 
	 case("/phpshop/admpanel/product/adm_price.php"):
	 lang.title("Price");
	 lang.txt("Price");
	 lang.txt("OK");
	 lang.txt("Cancel");
	 lang.txt("Old price");
	 lang.txt("Under the order");
	 lang.txt("Calculator");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_spec.php"):
	 lang.title("Additional conclusion");
	 lang.txt("Show in category");
	 lang.txt("OK");
	 lang.txt("Cancel");
	 lang.txt("Novelty");
	 lang.txt("Special offer");
	 lang.txt("Number");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_yml.php"):
	 lang.title("YML");
	 lang.txt("Show in YML");
	 lang.txt("Is present");
	 lang.txt("Under the order");
	 lang.txt("BID");
	 lang.txt("CBID");
	 lang.btn("OK");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_calc_sort.php"):
	 lang.title("Calculator of characteristics");
	 lang.txt("Calculator of characteristics");
	 lang.txt("Will choose better the characteristic");
	 lang.txt("Tabular record for loading through Excel");
	 lang.btn("Count");
	 lang.btn("Copy");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/page/admin_cat_content.php"):
	 lang.txt("Options");
	 lang.txt("Reference");
	 lang.txt("Name");
	 lang.txt("Real placing");
	 lang.img("Show");
	 lang.img("Only for the registered users");
	 lang.clean();
	 break;

	 case("/phpshop/admpanel/page/adm_catalogID.php"):
     lang.title("Category editing");
	 lang.txt("Category editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Category");
	 lang.txt("Position from above");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/page/adm_catalog_new.php"):
     lang.title("Creation of a new category");
	 lang.txt("Creation of a new category");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Category");
	 lang.txt("Position from above");
	 lang.btn("Clear");
	 lang.btn("Cancel");
	 lang.clean();
	 break;
	 
	 case("/phpshop/admpanel/page/adm_pagesID.php"):
     lang.title("Editing of Pages");
	 lang.txt("Editing of Pages");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Content");
	 lang.txt("Headers");
	 lang.txt("Category");
	 lang.txt("Name");
	 lang.txt("Link");
	 lang.txt("Sorting");
	 lang.txt("Options");
	 lang.txt("Show");
	 lang.txt("Only for the registered users");
	 lang.txt("Recommended goods for joint sale");
	 lang.txt("Enter identifiers (ID) the goods through a comma without a blank");
	 lang.txt("Header");
	 lang.txt("Header");
	 lang.txt("Header");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/page/adm_pages_new.php"):
     lang.title("Creation of new page");
	 lang.txt("Creation of new page");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Content");
	 lang.txt("Headers");
	 lang.txt("Category");
	 lang.txt("Name");
	 lang.txt("Position from above");
	 lang.txt("Sorting");
	 lang.txt("Options");
	 lang.txt("Show");
	 lang.txt("Only for the registered users");
	 lang.txt("Recommended goods for joint sale");
	 lang.txt("Enter identifiers (ID) the goods through a comma without a blank");
	 lang.txt("Header");
	 lang.txt("Header");
	 lang.txt("Header");
	 lang.btn("Clear");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/news/adm_newsID.php"):
     lang.title("News editing");
	 lang.txt("News editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Content");
	 lang.txt("Date");
	 lang.txt("Headers");
	 lang.txt("Announcement");
	 lang.txt("Dispatch to users");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/news/adm_news_new.php"):
     lang.title("News editing");
	 lang.txt("News editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Content");
	 lang.txt("Date");
	 lang.txt("Headers");
	 lang.txt("Announcement");
	 lang.txt("Dispatch to users");
	 lang.btn("Clear");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/baner/adm_banerID.php"):
     lang.title("Banner editing");
	 lang.txt("Banner editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Show a banner");
	 lang.txt("Hide a banner");
	 lang.txt("Limit");
	 lang.txt("Null counters");
	 lang.txt("Binding to page");
	 lang.txt("Example: page/, news/. It is possible to specify some addresses through a comma. ");
     lang.txt("Content");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/baner/adm_baner_new.php"):
     lang.title("Creation of a new banner");
	 lang.txt("Creation of a new banner");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Show a banner");
	 lang.txt("Hide a banner");
	 lang.txt("Limit");
	 lang.txt("Null counters");
	 lang.txt("Binding to page");
	 lang.txt("Example: page/, news/. It is possible to specify some addresses through a comma. ");
     lang.txt("Content");
	 lang.btn("Clear");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/menu/adm_menuID.php"):
     lang.title("Menu editing");
	 lang.txt("Menu editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Position");
	 lang.txt("Arrangement");
	 lang.txt("Left");
	 lang.txt("Right");
	 lang.txt("Show a menu");
	 lang.txt("Hide a menu");
	 lang.txt("Binding to page");
	 lang.txt("Example: page/, news/. It is possible to specify some addresses through a comma. ");
     lang.txt("Content");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/menu/adm_menu_new.php"):
     lang.title("Creation of the text block");
	 lang.txt("Creation of the text block");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Position");
	 lang.txt("Arrangement");
	 lang.txt("Left");
	 lang.txt("Right");
	 lang.txt("Show a menu");
	 lang.txt("Hide a menu");
	 lang.txt("Binding to page");
	 lang.txt("Example: page/, news/. It is possible to specify some addresses through a comma. ");
     lang.txt("Content");
	 lang.btn("Clear");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/link/adm_links_new.php"):
     lang.title("Creation of the New Reference");
	 lang.txt("Creation of the New Reference");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Link");
	 lang.txt("Show a link");
	 lang.txt("Hide a link");
	 lang.txt("Rating");
	 lang.txt("Rating influences sequence of an arrangement of references");
	 lang.txt("Content");
	 lang.txt("Button code");
	 lang.btn("Clear");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/link/adm_linksID.php"):
     lang.title("Reference editing ");
	 lang.txt("Reference editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Link");
	 lang.txt("Show a link");
	 lang.txt("Hide a link");
	 lang.txt("Rating");
	 lang.txt("Rating influences sequence of an arrangement of references");
	 lang.txt("Content");
	 lang.txt("Button");
	 lang.txt("Button code");
	 lang.btn("GO");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_oprosID.php"):
     lang.title("Interrogation editing ");
	 lang.txt("Interrogation editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Header");
	 lang.txt("Binding to pages");
	 lang.txt("Example: page/, news/. It is possible to specify some addresses through a comma");
	 lang.txt("Option");
	 lang.txt("Show");
	 lang.txt("Hide");
	 lang.txt("Answer variant");
	 lang.txt("Voices");
	 lang.txt("Relation");
	 lang.txt("Null data");
	 lang.txt("New position");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_opros_new.php"):
     lang.title("Creation of new interrogation");
	 lang.txt("Creation of new interrogation ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Header");
	 lang.txt("Binding to pages");
	 lang.txt("Example: page/, news/. It is possible to specify some addresses through a comma");
	 lang.txt("Option");
	 lang.txt("Show");
	 lang.txt("Hide");
	 lang.txt("Answer variant");
	 lang.txt("Voices");
	 lang.txt("Relation");
	 lang.txt("Null data");
	 lang.txt("New position");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_valueID.php"):
     lang.title("Answer editing");
	 lang.txt("Answer editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Answer");
	 lang.txt("Category");
	 lang.txt("Voices");
	 lang.txt("Sorting");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_value_new.php"):
     lang.title("Answer editing");
	 lang.txt("Answer editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Answer");
	 lang.txt("Category");
	 lang.txt("Voices");
	 lang.txt("Sorting");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/gbook/adm_gbookID.php"):
     lang.title("Editing of a response from");
	 lang.txt("Editing of a response from");
	 lang.txt("Specify data for record in base");
	 lang.txt("Date");
	 lang.txt("Sender");
	 lang.txt("Name");
	 lang.txt("Theme");
	 lang.txt("Response");
	 lang.txt("Answer");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/gbook/adm_gbook_new.php"):
     lang.title("Creation of a new response");
	 lang.txt("Creation of a new response");
	 lang.txt("Specify data for record in base");
	 lang.txt("Date");
	 lang.txt("Sender");
	 lang.txt("Name");
	 lang.txt("Theme");
	 lang.txt("Response");
	 lang.txt("Answer");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_userID.php"):
     lang.title("Editing of the user");
	 lang.txt("Editing of the user");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Content");
	 lang.txt("Rights");
	 lang.txt("Name");
	 lang.txt("Status");
	 lang.txt("Make active");
	 lang.txt("Make non active");
	 lang.txt("Change access");
	 lang.txt("Data are ciphered by algorithm");
	 lang.txt("Change");
	 lang.txt("Section");
	 lang.txt("Access");
	 lang.txt("Responses");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("News");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Orders");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Removal");
	 lang.txt("All orders");
	 lang.txt("Managers");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Rights");
	 lang.txt("Users");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Category");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Removal");
	 lang.txt("All items");
	 lang.txt("Reports");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Subscribers");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Pages");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Text blocks");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Banners");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Links");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Price");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Interrogation");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("BD");
	 lang.txt("Editing");
	 lang.txt("Management of a backup copy");
	 lang.txt("Options");
	 lang.txt("Editing");
	 lang.txt("Discounts");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Currencies");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Delivery");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation");
	 lang.txt("Shop Clons");
	 lang.txt("Review");
	 lang.txt("Editing");
	 lang.txt("Creation"); 
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_users_new.php"):
     lang.title("Creation of the new user");
	 lang.txt("Creation of the new user");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Content");
	 lang.txt("Name");
	 lang.txt("Status");
	 lang.txt("Make active");
	 lang.txt("Make non active");
	 lang.txt("Change access");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_userID.php"):
     lang.title("Editing of the User");
	 lang.txt("Editing of the User");
	 lang.txt("Specify data for record in base");
	 lang.txt("Status");
	 lang.txt("Authorised user");
	 lang.txt("Make active");
	 lang.txt("Make non active");
	 lang.txt("Change access");
	 lang.txt("Personal data");
	 lang.txt("Contact person");
	 lang.txt("Company");
	 lang.txt("INN");
	 lang.txt("KPP");
	 lang.txt("Phone");
	 lang.txt("Address");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_users_new.php"):
     lang.title("Creation of the new user");
	 lang.txt("Creation of the new user");
	 lang.txt("Specify data for record in base");
	 lang.txt("Status");
	 lang.txt("Authorised user");
	 lang.txt("Make active");
	 lang.txt("Make non active");
	 lang.txt("Change access");
	 lang.txt("Personal data");
	 lang.txt("Contact person");
	 lang.txt("Company");
	 lang.txt("INN");
	 lang.txt("KPP");
	 lang.txt("Phone");
	 lang.txt("Address");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_statusID.php"):
     lang.title("Discount editing");
	 lang.txt("Discount editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Use a");
	 lang.txt("column of the prices");
	 lang.txt("Discount");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_status_new.php"):
     lang.title("Creation of the New Discount");
	 lang.txt("Creation of the New Discount");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Use a");
	 lang.txt("column of the prices");
	 lang.txt("Discount");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_jurnalID.php"):
     lang.title("Editing of the User");
	 lang.txt("Editing of the User");
	 lang.txt("Specify data for record in base");
	 lang.txt("The IP-address will be added in the black list. The user with the given address cannot pass authorisation");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_jurnal_listlID.php"):
     lang.title("Editing of the User");
	 lang.txt("Editing of the User");
	 lang.txt("Specify data for record in base");
	 lang.txt("The IP-address will be added in the black list. The user with the given address cannot pass authorisation");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/report/adm_preID.php"):
     lang.title("Record editing");
	 lang.txt("Record editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Inquiry");
	 lang.txt("Enter search words through a comma ");
	 lang.txt("ID the goods");
	 lang.txt("Enter identifiers (ID) the goods through a comma");
	 lang.txt("Consider");
	 lang.txt("Block");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/report/adm_pre_new.php"):
     lang.title("Creation of New Record");
	 lang.txt("Creation of New Record");
	 lang.txt("Specify data for record in base");
	 lang.txt("Inquiry");
	 lang.txt("Enter search words through a comma ");
	 lang.txt("ID the goods");
	 lang.txt("Enter identifiers (ID) the goods through a comma");
	 lang.txt("Consider");
	 lang.txt("Block");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortID.php"):
     lang.title("Characteristic editing ");
	 lang.txt("Characteristic editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Description");
	 lang.txt("Options");
	 lang.txt("Subdirectory of 3rd level");
	 lang.txt("Filter");
	 lang.txt("Position");
	 lang.txt("Characteristic");
	 lang.txt("Sorting");
	 lang.txt("New item");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sort_new.php"):
     lang.title("Characteristic editing ");
	 lang.txt("Characteristic editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Description");
	 lang.txt("Options");
	 lang.txt("Subdirectory of 3rd level");
	 lang.txt("Filter");
	 lang.txt("Position");
	 lang.txt("Characteristic");
	 lang.txt("Sorting");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortcategoryID.php"):
     lang.title("Group editing ");
	 lang.txt("Group editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Description");
	 lang.txt("Position");
	 lang.txt("Characteristic");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortcategory_new.php"):
     lang.title("Group editing ");
	 lang.txt("Group editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Description");
	 lang.txt("Position");
	 lang.txt("Characteristic");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/mail/adm_news_writerID.php"):
     lang.title("Editing of the Address of Dispatch");
	 lang.txt("Editing of the Address of Dispatch");
	 lang.txt("Specify data for record in base");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/mail/adm_news_writer_new.php"):
     lang.title("Creation of the New Address of Dispatch");
	 lang.txt("Creation of the New Address of Dispatch");
	 lang.txt("Specify data for record in base");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system.php"):
     lang.title("System Options");
	 lang.txt("Options for Internet shop");
	 lang.txt("Specify data for record in base");
	 lang.txt("Skins");
	 lang.txt("Show-window");
	 lang.txt("Prices");
	 lang.txt("Messages");
	 lang.txt("Payment");
	 lang.txt("Modes");
	 lang.txt("Language");
	 lang.txt("Screenshot");
	 lang.txt("Quantity of positions on to page in shop");
	 lang.txt("Quantity of positions in a special offer");
	 lang.txt("Quantity of positions in novelties");
	 lang.txt("The goods at length for a show-window of the main page");
	 lang.txt("The size of affiliated windows to increase on");
	 lang.txt("Currency by default");
	 lang.txt("Currency in the account");
	 lang.txt("Currency for the clearing settlement");
	 lang.txt("Price increase ");
	 lang.txt("Consider the tax");
	 lang.txt("Tax");
	 lang.txt("Show a warehouse condition");
	 lang.txt("Emerging notice on the order");
	 lang.txt("Time of updating of the notice ");
	 lang.txt("The control of orders on a desktop");
	 lang.txt("Time of updating of the control of orders");
	 lang.txt("Cash payment to the courier");
	 lang.txt("Savings Bank receipt ");
	 lang.txt("Account in bank for the organisations ");
	 lang.txt("Credit cards through CyberPlat ");
	 lang.txt("Visual editor");
	 lang.txt("Use of the built in editor of a content");
	 lang.txt("Mode of sellers");
	 lang.txt("Mode Multibase");
	 lang.txt("Identifier in system Multibase of shop of the donor");
	 lang.txt("Administrative panel");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_promo.php"):
     lang.title("Promo options");
	 lang.txt("Options for attendance increase");
	 lang.txt("Specify data for record in base");
	 lang.txt("Core");
	 lang.txt("Category template");
	 lang.txt("Subcategory template");
	 lang.txt("Goods template");
	 lang.btn("Category");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("General");
	 lang.btn("Autoselection");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("General");
	 lang.btn("Autoselection");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Goog");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Goog");
	 lang.btn("General");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Category");
	 lang.btn("Subcategory");
	 lang.btn("Goog");
	 lang.btn("General");
	 lang.btn("Autoselection");
	 lang.btn("Blank");
	 lang.btn("Enter a word");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_recvizit.php"):
     lang.title("Adjustment of Requisites");
	 lang.txt("Adjustment of Requisites");
	 lang.txt("Specify data for record in base");
	 lang.txt("Shop name");
	 lang.txt("Owner");
	 lang.txt("Phones");
	 lang.txt("Mail for orders through a comma");
	 lang.txt("Organisation name");
	 lang.txt("Legal address");
	 lang.txt("Physical address");
	 lang.txt("INN");
	 lang.txt("KPP");
	 lang.txt("№ Organisation Accounts");
	 lang.txt("Bank name");
	 lang.txt("BIC");
	 lang.txt("№ Bank Accounts");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/discount/adm_discountID.php"):
     lang.title("Discount editing");
	 lang.txt("Discount editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Sum");
	 lang.txt("Sum is set");
	 lang.txt("Discount");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/discount/adm_discount_new.php"):
     lang.title("Creation of the New Discount");
	 lang.txt("Creation of the New Discount");
	 lang.txt("Specify data for record in base");
	 lang.txt("Sum");
	 lang.txt("Sum is set");
	 lang.txt("Discount");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_valutaID.php"):
     lang.title("Currency editing ");
	 lang.txt("Currency editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Designation");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.txt("Code ISO");
	 lang.txt("Course");
	 lang.txt("Sorting");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_valuta_new.php"):
     lang.title("Creation of New Currency");
	 lang.txt("Creation of New Currency");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Designation");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.txt("Code ISO");
	 lang.txt("Course");
	 lang.txt("Sorting");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_deliveryID.php"):
     lang.title("Delivery editing ");
	 lang.txt("Delivery editing ");
	 lang.txt("Specify data for record in base");
	 lang.txt("City");
	 lang.txt("Delivery by default");
	 lang.txt("Price");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.txt("Free delivery");
	 lang.txt("From above");
	 lang.txt("free delivery");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_delivery_new.php"):
     lang.title("Creation of the New Delivery");
	 lang.txt("Creation of the New Delivery");
	 lang.txt("Specify data for record in base");
	 lang.txt("City");
	 lang.txt("Delivery by default");
	 lang.txt("Price");
	 lang.txt("Consider");
	 lang.txt("Yes");
	 lang.txt("No");
	 lang.txt("Free delivery");
	 lang.txt("From above");
	 lang.txt("free delivery");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/servers/adm_servers_new.php"):
     lang.title("Creation of the New Clone");
	 lang.txt("Creation of the New Clone");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Host");
	 lang.txt("Active");
	 lang.txt("Not active");
     lang.btn("Reset");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/servers/adm_serversID.php"):
     lang.title("Clone editing");
	 lang.txt("Clone editing");
	 lang.txt("Specify data for record in base");
	 lang.txt("Name");
	 lang.txt("Host");
	 lang.txt("Active");
	 lang.txt("Not active");
     lang.btn("Remove");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_docsstyle.php"):
     lang.title("Document circulation");
	 lang.txt("Document circulation");
	 lang.txt("Specify data for record in base");
	 lang.txt("Logo");
	 lang.txt("Advertising block");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/window/adm_window.php"):
     lang.title("Action");
	 lang.txt("Action");
	 lang.txt("Specify data for record in base");
	 lang.txt("You are assured, that want ");
	 try{
	 lang.txt("");
	 lang.txt("");
	 }catch(e){}
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/dumper/dumper.php"):
     lang.title("Work with base");
	 lang.txt("Work with base");
	 lang.txt("Specify DB commands");
	 lang.txt("Creation of a backup copy of a DB");
	 lang.txt("BD");
	 lang.txt("Filter of tables");
	 lang.txt("Compression method");
	 lang.txt("Compression degree");
	 lang.txt("Restoration of a DB from a backup copy");
	 lang.txt("BD");
	 lang.txt("File");
	 lang.btn("Cancel");
	 break;
	 
	 case("/phpshop/admpanel/sql/adm_sql.php"):
     lang.title("Work with base");
	 lang.txt("Work with base");
	 lang.txt("Specify commands for MySQL");
	 try{
	 lang.txt("Choose a command sql");
	 lang.txt("Optimise base");
	 lang.txt("Repair base");
	 lang.txt("Remove category");
	 lang.txt("Remove page");
	 lang.txt("Clear base");
	 lang.txt("Destroy base");
	 lang.btn("Load from a file");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 }catch(e){}
	 
	 try{
	 var txtLang2 = document.getElementsByName("btnLang2");
	 btnLang2[0].value = "Back";
	 btnLang2[1].value = "Cancel";
	 }catch(e){}
	 break;
	 
	 case("/phpshop/admpanel/sql/adm_sql_file.php"):
     lang.title("Work with base");
	 lang.txt("Work with base");
	 lang.txt("Specify commands for MySQL");
	 try{
	 lang.txt("Loading SQL");
	 lang.txt("Will choose a file");
	 lang.btn("Execute SQL a command");
	 lang.btn("Reset");
	 lang.btn("Cancel");
	 }catch(e){}
	 
	 try{
	 var txtLang2 = document.getElementsByName("btnLang2");
	 btnLang2[0].value = "Back";
	 btnLang2[1].value = "Cancel";
	 }catch(e){}
	 break;
	 
	 case("/phpshop/admpanel/window/adm_about.php"):
	 lang.title("About program");
	 lang.txt("About program");
	 lang.txt("Versions of modules and the licence agreement");
	 lang.txt("Module");
	 lang.txt("Version");
	 lang.txt("Update");
	 lang.txt("Version");
	 lang.txt("It is established");
	 lang.txt("Updating is accessible");
	 lang.txt("Support");
	 lang.txt("Date");
	 lang.txt("Beginning");
	 lang.txt("End");
	 lang.txt("Prolongation of technical support");
	 lang.txt("Licence agreement");
	 lang.txt("I accept conditions of the licence agreement");
	 lang.btn("Cancel");
	 
	 break;
   }
     }catch(e){alert("The translation engine has informed about shortages of an element.\nTransfer can be not full!");}
}}
 