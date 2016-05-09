/*
 * @author Jamey Ballard
 * @name button.js
 * @date 2016/5/05
 * @about contains functions that called from index.html to change the display of the main page
 */

/*
 * @pre called from a button press in the main page in index.html
 * @post if the add filter button is pressed, the filters are added and the button changes to 'hide filters', if is pressed again, the button changes back and the filters are hidden
 * @param None
 * @return None
 */
function filters()
{
    if(document.getElementById('Filters').style.display != "none" && document.getElementById('Filters').style.display != "")
    {
        document.getElementById('Filters').style.display = "none";
        document.getElementById('Hide_Filters').style.display="none";
        document.getElementById('Add_Filters').style.display="inline";
    }else
    {
        document.getElementById('Filters').style.display = "block";
        document.getElementById('Add_Filters').style.display="none";
        document.getElementById('Hide_Filters').style.display="inline";
    }
}
