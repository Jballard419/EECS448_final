function filters()
{


    if (document.getElementById('Filters').style.display != "none") {
        document.getElementById('Filters').style.display = "none";
        
        document.getElementById('Add_Filters').style.display="inline";

    }else {
        document.getElementById('Filters').style.display = "block";
        document.getElementById('Add_Filters').style.display="none";
    }




}



function isnamecalled()
{
      var variable="channel_name"
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){

                document.forms['rand_stream'].style.display= "none";



               }
       }
       return(false);
}
