// Часы
var	monthName =	new Array("January", "February", "Marth", "April", "May", "June", "July", "August", "September", "October","November", "December")
var dayNameFull = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
var dayName = new Array("M","T","W","Th","Fr","St","Su")


// Объект языка версия 1.0
lang = new Object();
num_txt=0;
num_btn=0;
num_img=0;
error=0;
d = document;
lang.title = function(txt){// Смена заголовка
             document.title = txt;
             }
lang.txt = function(txt){// Смена текста
            var obj = d.getElementsByName("txtLang");
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
            num_txt=0;num_btn=0;num_img=0;
            }

icon = new Object();
num_icon = 0;
icon.img = function(txt){// Смена альты картинки
            var obj = document.getElementsByName("iconLang");
			if(obj[num_icon]){
            obj[num_icon].alt = txt;
            num_icon++;
            }}


// Смена языка
function DoCheckInterfaceLang(file,tip){
     if(tip == "top") d = window.opener.document; else d = document;
	 var txtLang = d.getElementsByName("txtLang");
	 var txtLangs = d.getElementsByName("txtLangs");
	 var txtLang2 = d.getElementsByName("txtLang2");
	 var btnLang = d.getElementsByName("btnLang");
	 var imgLang = d.getElementsByName("imgLang");
  try{
  switch(file){
  
     case("index"):
	 txtLang[0].innerHTML = "Input in the Administrative Panel";
	 txtLang[1].innerHTML = "Specify the user and the password";
	 txtLang[2].innerHTML = "User";
	 txtLang[3].innerHTML = "Password";
	 btnLang[0].value = "Exit";
	 txtLang[4].innerHTML = "Open in a current window";
	 try{
	 txtLangs[0].innerHTML = "Remember a login and the password";
	 txtLang[5].innerHTML = "Send the password on E-mail the user";
	 }catch(e){
	 txtLang2[0].innerHTML = "Not to remember a login and the password";
	 txtLang[5].innerHTML = "Send the password on E-mail the user";
	 }
	 break;
  
     case("csv_base"):
	 try{
     txtLang[0].innerHTML = "Master of loading of commodity base Excel";
	 txtLang[1].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 txtLang[2].innerHTML = "Operation course";
	 txtLang[3].innerHTML = "Step 1 - download a file example ";
	 txtLang[4].innerHTML = "Step 2 - choose in advance filled file ";
	 txtLang[5].innerHTML = "Step 3 - accept changes in a file ";
	 txtLang[6].innerHTML = "Step 4 - wait operation performance ";
	 txtLang[7].innerHTML = "Step 5 - pass in section the Catalogue - the Unloaded goods - Base Excel";
     txtLang[8].innerHTML = "Step 6 - Allocate with a tag the goods and will choose a folder for carrying over by an option With noted - to Transfer to the catalogue. If it is required, make corresponding catalogues. ";
	 txtLang[9].innerHTML = "Attention";
	 txtLang[10].innerHTML = "Attentively check preliminary loaded data in avoidance of incorrect loading of data";
     txtLang[11].innerHTML = "Download a file example";
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "ID";
	 txtLangs[1].innerHTML = "Category ID";
	 txtLangs[2].innerHTML = "Name";
	 txtLangs[3].innerHTML = "Small picture";
	 txtLangs[4].innerHTML = "Nig Picture";
	 txtLangs[5].innerHTML = "Price";
	 txtLangs[6].innerHTML = "Price 2";
	 txtLangs[7].innerHTML = "Presence";
	 txtLangs[8].innerHTML = "Choose other file";
	 txtLangs[9].innerHTML = "Accept changes";
	 
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "Loading of commodity base is executed";
	 txtLang2[1].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 }catch(e){}
	 
	 break;
	 
  
     case("csv"):
	 try{
     txtLang[0].innerHTML = "Master of loading of a price";
	 txtLang[1].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 txtLang[2].innerHTML = "Operation course";
	 txtLang[3].innerHTML = "Step 1 - to choose in advance unloaded price";
	 txtLang[4].innerHTML = "Step 2 - to accept changes in a price";
	 txtLang[5].innerHTML = "Step 3 - to wait operation performance";
	 txtLang[6].innerHTML = "Attention";
	 txtLang[7].innerHTML = "Attentively check preliminary loaded data in avoidance of incorrect loading of data";
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "Name";
	 txtLangs[1].innerHTML = "Price";
	 txtLangs[2].innerHTML = "New price";
	 txtLangs[3].innerHTML = "Under the order";
	 txtLangs[4].innerHTML = "Article";
	 txtLangs[5].innerHTML = "New";
	 txtLangs[6].innerHTML = "Special offer";
	 txtLangs[7].innerHTML = "YML Market";
	 txtLangs[8].innerHTML = "In a warehouse";
	 txtLangs[9].innerHTML = "Presence";
	 txtLangs[10].innerHTML = "Sorting";
	 txtLangs[11].innerHTML = "Choose other file";
	 txtLangs[12].innerHTML = "Accept changes";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "Price loading is executed";
	 txtLang2[1].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 }catch(e){}
	 
	 break;
	 
     case("servers"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Host";
	 txtLang[2].innerHTML = "New item";
	 break;
  
     case("delivery"):
     txtLang[0].innerHTML = "City";
	 txtLang[1].innerHTML = "Sum";
	 txtLang[2].innerHTML = "From above free of charge";
	 txtLang[3].innerHTML = "New item";
	 break;
   
     case("valuta"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Designation in shop";
	 txtLang[2].innerHTML = "Code of currency ISO";
	 txtLang[3].innerHTML = "Course";
	 txtLang[4].innerHTML = "New item";
	 break;
	 
	 case("discount"):
     txtLang[0].innerHTML = "Sim";
	 txtLang[1].innerHTML = "Discount";
	 txtLang[2].innerHTML = "New item";
	 break;
  
  
     case("stats1"):
	 try{
     txtLang[0].innerHTML = "Master of creation of reports";
	 txtLang[1].innerHTML = "Will choose a report kind";
	 txtLang[2].innerHTML = "Report of orders by date";
	 txtLang[3].innerHTML = "From date";
	 txtLang[4].innerHTML = "On date";
	 txtLang[5].innerHTML = "ID the goods";
	 txtLang[6].innerHTML = "From date";
	 txtLang[7].innerHTML = "On date";
	  }catch(e){}
	  try{
	 txtLangs[0].innerHTML = "Date";
	 txtLangs[1].innerHTML = "Quantity";
	 txtLangs[2].innerHTML = "Sum";
	 txtLangs[3].innerHTML = "Return to a report choice";
	 txtLangs[4].innerHTML = "Unload in Excel";
	 txtLangs[5].innerHTML = "Report unloading is carried out in format CSV ";
	 }catch(e){}
	  try{
	 txtLang2[0].innerHTML = "№ Order";
	 txtLang2[1].innerHTML = "Receipt";
	 txtLang2[2].innerHTML = "Name";
	 txtLang2[3].innerHTML = "Quantity";
	 txtLang2[4].innerHTML = "In order";
	 txtLang2[5].innerHTML = "Discount";
	 txtLang2[6].innerHTML = "Sum";
	 txtLangs[7].innerHTML = "Return to a report choice";
	 }catch(e){}
	 
	 break;
  
     case("news_writer"):
     txtLang[0].innerHTML = "Date";
	 txtLang[1].innerHTML = "New item";
	 txtLang[2].innerHTML = "Unloading";
	 txtLang[3].innerHTML = "The unloading of base of subscribers is carried out in a format";
	 break;
  
     case("sort_group"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "New item";
	 break;
  
     case("sort"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "New item";
	 break;
	 
     case("search_pre"):
     txtLang[0].innerHTML = "With the noted";
	 txtLang[1].innerHTML = "To remove from base";
	 txtLang[2].innerHTML = "Block";
	 txtLang[3].innerHTML = "Involve";
	 txtLang[4].innerHTML = "To note all";
	 txtLang[5].innerHTML = "To remove a mark from all";
	 txtLang[6].innerHTML = "Inquiry";
	 txtLang[7].innerHTML = "ID the goods";
	 imgLang[0].alt = "New item";
	 imgLang[1].alt = "Search Log";
	 break;
     
	 case("search_jurnal"):
     txtLang[0].innerHTML = "With the noted";
	 txtLang[1].innerHTML = "To add in search base";
	 txtLang[2].innerHTML = "To remove from magazine";
	 txtLang[3].innerHTML = "To note all";
	 txtLang[4].innerHTML = "To remove a mark from all";
	 txtLang[5].innerHTML = "Inquiry";
	 txtLang[6].innerHTML = "Date";
	 txtLang[7].innerHTML = "Found";
	 txtLang[8].innerHTML = "Searched in a category";
	 txtLang[9].innerHTML = "Arrangement";
	 btnLang[0].value = "Show";
	 imgLang[0].alt = "Search readdressing";
	 break;
	 
	 case("users_jurnal_black"):
     txtLang[0].innerHTML = "Date";;
	 txtLang[1].innerHTML = "Country";
	 break;
	 
     case("users_jurnal"):
     txtLang[0].innerHTML = "Enter";
	 txtLang[1].innerHTML = "User";
	 txtLang[2].innerHTML = "Date";
	 txtLang[3].innerHTML = "Country";
	 btnLang[0].value = "Show";
	 imgLang[0].alt = "Black list";
	 break;
  
     case("shopusers_status"):
     txtLang[0].innerHTML = "Status";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Discount";
	 txtLang[3].innerHTML = "New status";
	 break;
  
     case("shopusers"):
	 txtLang[0].innerHTML = "With the noted";
	 txtLang[1].innerHTML = "Block";
	 txtLang[2].innerHTML = "Unblock";
	 txtLang[3].innerHTML = "Remove";
	 txtLang[4].innerHTML = "Note all";
	 txtLang[5].innerHTML = "Remove a mark";
	 btnLang[0].value = "Search";
	 imgLang[0].alt = "New User";
	 imgLang[1].alt = "Statuses of users";
	 txtLang[6].innerHTML = "Status";
	 txtLang[7].innerHTML = "All";
	 txtLang[8].innerHTML = "Authorised user";
	 btnLang[1].value = "Show";
     txtLang[9].innerHTML = "Status";
	 txtLang[10].innerHTML = "Name";
	 txtLang[11].innerHTML = "Status";
	 txtLang[12].innerHTML = "Discount";
	 txtLang[13].innerHTML = "Last input";
	 break;
  
     case("users"):
     txtLang[0].innerHTML = "Status";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Input";
	 txtLang[3].innerHTML = "New user";
	 break;
  
     case("gbook"):
     txtLang[0].innerHTML = "Date";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Content";
	 txtLang[3].innerHTML = "New Response";
	 break;
  
     case("opros"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Binding";
	 txtLang[2].innerHTML = "New Interrogation";
	 break;
  
     case("links"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Content";
	 txtLang[2].innerHTML = "Button";
	 txtLang[3].innerHTML = "New link";
	 break;
  
     case("page_menu"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Binding";
	 txtLang[2].innerHTML = "Arrangement";
	 txtLang[3].innerHTML = "New menu";
	 break;
     
	 case("baner"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Displays today";
	 txtLang[2].innerHTML = "Total";
	 txtLang[3].innerHTML = "Limit of displays";
	 txtLang[4].innerHTML = "New banner";
	 break;
	 
	 case("news"):
	 btnLang[0].value = "Dispatch";
     txtLang[0].innerHTML = "Date";
	 txtLang[1].innerHTML = "Headers";
	 txtLang[2].innerHTML = "Content";
	 imgLang[0].alt = "New news";
	 break;
     
	 case("page_site_catalog"):
	 lang.txt("Page search");
	 lang.btn("Show");
	 lang.img("New page");
	 lang.img("New page category");
	 lang.img("Edit category");
	 lang.img("Show all pages");
	 lang.txt("Category");
	 lang.img("Open all");
	 lang.img("Close all");
	 lang.clean();
	 break;
  
     case("icon"):
	 icon.img("Category");
     icon.img("Orders");	
	 icon.img("Reports");	
	 icon.img("Price loading");
	 icon.img("Price unloading");
	 icon.img("Options");
	 icon.img("Keywords & Titles");
	 icon.img("Requisites");
	 icon.img("Pages");
	 icon.img("News");
	 icon.img("Banners");
	 icon.img("Text blocks");
	 icon.img("Responses");
	 icon.img("References");
	 icon.img("Interrogations");
	 icon.img("Users");
	 icon.img("Managers");
	 icon.img("Authorisation Log");
	 icon.img("Search Log");
	 icon.img("SQL");
	 icon.img("Backup copy");
	 icon.img("Shop area");
	 icon.img("Exit");
	 lang.clean();
	 break;
  
	 case("orders"):
	 d.getElementById("btnShow").value = "Show";
	 d.getElementById("btnSearch").value = "Search";
	 d.getElementById("btnStatus").value = "Show";
     txtLang[0].innerHTML = "Status";
	 txtLang[1].innerHTML = "All";
	 txtLang[2].innerHTML = "New";
	 txtLang[3].innerHTML = "Carried";
	 txtLang[4].innerHTML = "Delivered";
	 txtLang[5].innerHTML = "Executed";
	 txtLang[6].innerHTML = "Cancelled";
	 txtLang[7].innerHTML = "№ Order";
	 txtLang[8].innerHTML = "Receipt";
	 txtLang[9].innerHTML = "Buyer";
	 txtLang[10].innerHTML = "Qu-ty";
	 txtLang[11].innerHTML = "Dis.";
	 txtLang[12].innerHTML = "Sum";
	 txtLang[13].innerHTML = "Processed";
	 txtLang[14].innerHTML = "Status";
	 break;
	 
	 case("cat_prod"):
	 var txtLang = document.getElementsByName("txtLang");
	 var imgLang = document.getElementsByName("imgLang");
	 txtLang[0].innerHTML = "Search";
	 document.getElementById("btnShow").value = "Show";
	 lang.img("New category");
	 lang.img("New item");
	 lang.img("Edit a subcategory");
	 lang.img("Conclusion of all items");
	 lang.img("Characteristics");
	 lang.img("Calculator of characteristics");
	 lang.img("Open All");
	 lang.img("Close All");
	 txtLang[1].innerHTML = "With noted";
	 txtLang[2].label = "Actions";
	 txtLang[3].innerHTML = "Transfer";
	 txtLang[4].innerHTML = "Make a copy";
	 txtLang[5].innerHTML = "Connect with clauses ";
	 txtLang[6].innerHTML = "Export in Excel ";
	 txtLang[7].label = "Novelties";
	 txtLang[8].innerHTML = "Add in novelties";
	 txtLang[9].innerHTML = "Clean from novelties ";
	 txtLang[10].label = "Special offer";
	 txtLang[11].innerHTML = "Add in novelties";
	 txtLang[12].innerHTML = "Clean from novelties";
	 txtLang[13].label = "Conclusion";
	 txtLang[14].innerHTML = "Clean from sale";
	 txtLang[15].innerHTML = "Add in sale";
	 txtLang[16].innerHTML = "Remove from base";
	 txtLang[17].label = "YML Yandex the Market";
	 txtLang[18].innerHTML = "Clean from YML a price";
	 txtLang[19].innerHTML = "Add in YML a price";
     txtLang[20].innerHTML = "Note all";
	 txtLang[21].innerHTML = "Remove a mark";
	 txtLang[22].innerHTML = "Categories";
	 lang.clean();
	 break;

   }
   }catch(e){}
   
}
