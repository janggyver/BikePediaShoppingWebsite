var delay = 300;

var N = (document.all) ? 0 : 1;
var count = 0;
var count_open = 0;
var open_items = new Array();
var head = new Array();
var item_arr = new Array();
var T1 = null;
var hcc = 0;

var container = new Array();
var ctc = 0;

var screenw = screen.width;

function create_menu(mid,a_id,prop_id)
{
	//window.alert("AHHH");
	l_men = prop_id[1];
	t_men = prop_id[2];
	
	//document.write('prop='+l_men);
	for(i=0;i<a_id.length;i++)
	{ 
  		if(a_id[i][7]) {id = count_open;count_open++;}
  		else id = -1;
  		
  	height = prop_id[4]+6;
  	if(N) height -= 4;
  	width = prop_id[3];
  	if(N) width -= 12;
  	if(a_id[i][1] != null) 
  	{
		document.write("<a href='"+a_id[i][1]+"' ");
  		if(a_id[i][2] != null) 
		document.write("target='"+a_id[i][2]+"' style='text-decoration:none'");
  		document.write(">");
  	}
  		//window.alert("ye");
	  document.write("<div style=\"position:absolute;top:"+t_men+";left:"+(l_men));
	  document.write(";padding:"+prop_id[21]+"px 0px 0px "+prop_id[22]+"px;cursor:hand");
	  document.write(";width:"+width);
	  document.write(";height:"+height);
	  document.write(";font-size:"+prop_id[9]+"px");
	  document.write(";font-family:"+prop_id[10]);
	  document.write(";background-color:"+a_id[i][4]);
	  document.write(";color:"+a_id[i][3]);
	  document.write(";border:"+prop_id[6]+"px "+prop_id[11]+" "+prop_id[7]);
  	if(prop_id[8] == 1) 
		document.write(";font-weight:bold;");
  		document.write("\" onmouseout=\"head_out("+id+",-1,"+hcc+",-1,'','')\" onmouseover=\"head_over(this.id,'"+a_id[i][5]+"','"+a_id[i][6]+"',"+id+",-1,"+hcc+",-1,'','')\" id="+mid+"_"+hcc+">");
  		document.write("&nbsp;"+a_id[i][0]+"</div>");
  	if(a_id[i][1] != null) document.write ("</a>");
  		head[hcc] = new Array(a_id[i][3],a_id[i][4],a_id[i][5],a_id[i][6],mid,"none");
  	if(a_id[i][7]) 
   	{
   		topv = prop_id[2] + height + prop_id[12];
   		if(N) topv += 2
   		left = l_men;
   		arr = a_id[i][7];
   		if(N) topv += prop_id[6] + prop_id[15];
   		//		topv = prop_id[15];
   			iid = ""+id
   			add_col(t_men,l_men,arr,prop_id,mid,iid,hcc,"","","","r");
   	}
	   //l_men += (prop_id[5] + prop_id[3]);
	   //l_men = prop_id[1];
	   t_men = t_men + height;
	   //if(N) l_men += (2*(prop_id[6] + prop_id[21] +2)); 
	   hcc++;
}
empty_container();
}
function head_out(open,confirm,header,way,lst_items,item)
{
 if(T1 != null) clearTimeout(T1)
 if(item != "") item_arr[parseInt(item)][6] = "none";
 if(lst_items != "") {
 lb = lst_items.split("/");
 for (i=0;i<lb.length;i++) 
  {
   item_arr[lb[i]][6] = "none";
  }
 }
 if(way != -1){
 la = way.split("/");
 for (i=0;i<la.length;i++) open_items[la[i]][0] = 'none';
 }
 if(confirm != -1) {open_items[confirm][0] = 'none'}
 if(open != -1) {open_items[open][0] = 'none';}
 head[header][5] = "none";
 T1 = setTimeout("close_items()",delay);
}

function head_over(id,text,bg,open,confirm,header,way,lst_items,item)
{
 if(T1 != null) clearTimeout(T1)
 if(item != "") item_arr[item][6] = "";
 head[header][5] = "";
 if(lst_items != "") {
 lb = lst_items.split("/");
 for (i=0;i<lb.length;i++) 
  {
   item_arr[lb[i]][6] = "";
  }
 }
 if(way != -1){
 la = way.split("/");
 for (i=0;i<la.length;i++) open_items[la[i]][0] = '';
 }
  if(open != -1)
 {
  len = open_items[open][4] - open_items[open][3];
  for(i=0;i<=len;i++)
  {
    name = open_items[open][2] +"_s"+(open_items[open][3]+i);
    document.getElementById(name).style.display = '';
  }
  open_items[open][0] = '';
 }
 if(confirm != -1) open_items[confirm][0] = '';
 document.getElementById(id).style.backgroundColor = bg;
 document.getElementById(id).style.color = text;
 //document.getElementById(id).style.border = '1px pink';
 T1 = setTimeout("close_items()",0);


}

function add_col(top,left,arr,prop_id,mid,iid,from,way,citems,lst_item,dir)
{
 if(way == ""){vway = iid;}
 else vway = way + "/" + iid;
 if(citems != "") vcitems = citems +"/"+ lst_item;
 else vcitems = lst_item;
 t=top;
 ll = left;
 if(dir == "r")
 {
 if((ll+(prop_id[13]+prop_id[20]+50)) > screenw)
 {
  ll -= 2*(prop_id[13] + prop_id[20])
   dir = "l";
 }
 }
 else
 {
 if(ll < 0)
  {
    ll += 2*(prop_id[13] + prop_id[20])
    dir = "r";
  }
 }
 start = count
 for(j=0;j<arr.length;j++)
 {
  if(arr[j][7]){tid = count_open;count_open++;}
  else tid = -1;
  height = prop_id[14];
  if(N) {height -= 5;t+=4;}
  width = prop_id[13]
  if(N) {width -= 7;}
  if(arr[j][1] != null) 
  {
  	document.write("<a href='"+arr[j][1]+"' ");
  	document.write("style='text-decoration:none;color:"+arr[j][3]+"'");
  if(arr[j][2] != null) 
  	document.write("target='"+arr[j][2]+"' style='text-decoration:none'");
  	document.write(">");
  }
  document.write("<div class='item_class' style=\"display:none;position:absolute;left:"+(ll+158)+";top:"+t);
  document.write(";filter:alpha(opacity="+prop_id[0]+"); -moz-opacity:"+prop_id[0]+"%;");
  document.write(";width:"+width);
  document.write(";height:"+height);
  document.write(";font-size:"+prop_id[18]+"px");
  document.write(";font-family:"+prop_id[19]);
  document.write(";background-color:"+arr[j][4]);
  document.write(";color:"+arr[j][3]);
  document.write(";cursor:hand");
  document.write(";border:"+prop_id[15]+"px "+prop_id[16]+" "+prop_id[17]);
  document.write("\" onmouseover=\"head_over(this.id,'"+arr[j][5]+"','"+arr[j][6]+"',"+tid+","+iid+","+from+",'"+vway+"','"+vcitems+"','"+count+"')\" onmouseout=\"head_out("+tid+","+iid+","+from+",'"+vway+"','"+vcitems+"','"+count+"')\" id="+mid+"_s"+count+">&nbsp;"+arr[j][0]);
  if(arr[j][7])
  {
  	ileft = prop_id[13] - 20;
  	document.write("<img src='"+prop_id[23]+"' border=0 style='position:absolute;left:"+ileft+";top:3;'>");
  }
  document.write("</div>")
  if(arr[j][1] != null)document.write("</a>");
  item_arr[count] = new Array(arr[j][3],arr[j][4],arr[j][5],arr[j][6],mid,from,"none",count);
  if(arr[j][7]) 
  {
  	if(dir == "r") l = ll + prop_id[13] + prop_id[20];
  	else l = ll - prop_id[13] - prop_id[20];
  	if(N) t-=4;
  	container[ctc] = new Array(0,t,l,arr[j][7],prop_id,mid,tid,from,vway,vcitems,count,dir);
  	if(N) t+=4;
  	ctc++;
  }
   count++;
  	t += height -1;
  	if(N) t+= 1*(prop_id[15]);
 }
 end = count-1;
 open_items[iid] = new Array("none",iid,mid,start,end,from,vway,vcitems,count);
 vway = "";
   way = "";
  vcitems= "";
}
//Free JavaScript at http://www.ScriptBreaker.com
function empty_container()
{
 for(i=0;i<container.length;i++)
 {
  if (container[i][0] == 0)
  {
   add_col(container[i][1],container[i][2],container[i][3],container[i][4],container[i][5],container[i][6],container[i][7],container[i][8],container[i][9],container[i][10],container[i][11]);
   container[i][0] = 1;
  }
 }

}

function close_items()
{
T1 = null;
 for(i=0;i<open_items.length;i++)
 {
   id = open_items[i][2] +"_s"+open_items[i][3];
   if(document.getElementById(id).style.display  != open_items[i][0])
   {
   len = open_items[i][4] - open_items[i][3];
   for(j=0;j<=len;j++)
   {
     name = open_items[i][2] +"_s"+(open_items[i][3]+j);
     document.getElementById(name).style.display = open_items[i][0];
   }
   }
 }
 for (j=0;j<item_arr.length;j++) 
  {
   i = parseInt(item_arr[j][7]);
   name = item_arr[i][4] + "_s" + i;
   if(item_arr[i][6] == "")
   {
    document.getElementById(name).style.color = item_arr[i][2];
    document.getElementById(name).style.backgroundColor = item_arr[i][3];
   }
   else
   {
    document.getElementById(name).style.color = item_arr[i][0];
    document.getElementById(name).style.backgroundColor = item_arr[i][1];
   }
  }
  for(k=0;k<head.length;k++)
  {
   name = head[k][4]+"_"+k;
   if(head[k][5] == "")
   {
   document.getElementById(name).style.color = head[k][2];
   document.getElementById(name).style.backgroundColor = head[k][3];
   }
   else
   {
   document.getElementById(name).style.color = head[k][0];
   document.getElementById(name).style.backgroundColor = head[k][1];
   }
  }
}