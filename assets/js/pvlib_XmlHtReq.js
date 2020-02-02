//----------------------------------------------------
// Private JS Api Library
// XML HTTP Requet Lib
//----------------------------------------------------


//--------------------------------------------------------
// Create XMLHttpRequest Object
//
function Pvl_XmlHtReq_CreateObj(){
    try{
        return new XMLHttpRequest();
    }catch(e){}
    try{
        return new ActiveXObject('MSXML2.XMLHTTP.6.0');
    }catch(e){}
    try{
        return new ActiveXObject('MSXML2.XMLHTTP.3.0');
    }catch(e){}
    try{
        return new ActiveXObject('MSXML2.XMLHTTP');
    }catch(e){}

    return null;
}
