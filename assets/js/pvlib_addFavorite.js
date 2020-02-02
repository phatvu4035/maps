//----------------------------------------------------
// Private JS Api Library
// XML HTTP Requet Lib
//----------------------------------------------------


//set dir path -----------------------
if(Url_pvlib_addFavorite == null){
    //get path from script element
    var elmnt_script = document.getElementsByTagName('script');
    var url_fl    = elmnt_script[elmnt_script.length-1].src;
    var url_dir   = url_fl.substring(0,url_fl.lastIndexOf('/')+1);
    //set dir path ----------------
    var Url_pvlib_addFavorite = url_dir;
    //-----------------------------
}
//------------------------------------


//----------------------------------------------
//
function Pvl_addFavorite(rec_id){

    //init --------------------------------
    //get add input value
    var send_data = "id=" + rec_id;
    var url       = Url_pvlib_addFavorite + "?cbcm=addFavorite";
    //-------------------------------------

    // make XMLHttpRequest Object ---
    var xhr = Pvl_XmlHtReq_CreateObj();
    xhr.onreadystatechange = function(){
        if(xhr.readyState==4 && xhr.status==200){
            //send success --------
            if(xhr.responseText == 'error'){
                var msg = "Error";
            }else{
                var msg = "縺頑ｰ励↓蜈･繧願ｿｽ蜉�縺励∪縺励◆";
            }
            alert(msg);
            //Pvl_addSelectOpt(sel_htmid,inp_htmid,xhr.responseText)
            //alert(xhr.responseText);
            /* document.getElementById("div_id_xxxx").innerHTML=xhr.responseText; */
            //---------------------
        }
    }

    //set post method
    xhr.open("POST" , url,true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
    //send data
    xhr.send(send_data);
}

