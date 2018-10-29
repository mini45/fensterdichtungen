/* --------------------------------------------------------------
   $Id: general.js 899 2005-04-29 02:40:57Z hhgag $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   --------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(general.js,v 1.2 2001/05/20); www.oscommerce.com 
   (c) 2003	 nextcommerce (general.js,v 1.4 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   --------------------------------------------------------------*/

function showLayer(Name) {

        switch (Name) {
        case 'config':
        document.layers.l_export.visibility = "hide";
        document.layers.l_config.visibility = "show";
        document.layers.l_import.visibility = "show";
        break;

        case 'export':

        break;

        case 'import':

        break;
    }

}


function toggleBox(szDivID) {

  if (document.layers) { // NN4+
    if (document.layers[szDivID].visibility == 'visible') {
        document.layers[szDivID].visibility = "hide";
        document.layers[szDivID].display = "none";
        document.layers[szDivID+"SD"].fontWeight = "normal";
    } else {
        document.layers[szDivID].visibility = "show";
        document.layers[szDivID].display = "inline";
    }
  } else if (document.getElementById) { // gecko(NN6) + IE 5+
    var obj = document.getElementById(szDivID);
    if (obj.style.visibility == 'visible') {
        obj.style.visibility = "hidden";
        obj.style.display    = "none";
    } else {
        obj.style.visibility = "visible";
        obj.style.display    = "inline";
    }
  } else if (document.all) { // IE 4
    if (document.all[szDivID].style.visibility == 'visible') {
        document.all[szDivID].style.visibility = "hidden";
        document.all[szDivID].style.display = "none";
    } else {
        document.all[szDivID].style.visibility = "visible";
        document.all[szDivID].style.display = "inline";
    }
  }
}

function SetFocus() {
  if (document.forms.length > 0) {
    var field = document.forms[0];
    for (i=0; i<field.length; i++) {
      if ( (field.elements[i].type != "image") && 
           (field.elements[i].type != "hidden") && 
           (field.elements[i].type != "reset") && 
           (field.elements[i].type != "submit") ) {

        document.forms[0].elements[i].focus();

        if ( (field.elements[i].type == "text") || 
             (field.elements[i].type == "password") )
          document.forms[0].elements[i].select();
        
        break;
      }
    }
  }
}

/** BOF AGI GOOGLE-XML-EXPORT www.andreas-guder.de **/
function showAgiLanguageTab(me, listclass, pressedKey)
{
  var myparents       = me.parentNode;
  var selectorChilds  = myparents.childNodes;
  var showarea        = document.getElementById(listclass);
  var areaChilds      = showarea.childNodes;
  for (var i=0; i < selectorChilds.length; i++)
  {
    if (selectorChilds[i].nodeType == 1 && selectorChilds[i].nodeName.toLowerCase() == 'li')
      selectorChilds[i].className = '';
  }
  me.className = 'active';
  var tCount = 0;
  for (var i=0; i < areaChilds.length; i++)
  {
    if (areaChilds[i].nodeType == 1 && areaChilds[i].nodeName.toLowerCase() == 'li')
    {
      areaChilds[i].className = tCount == pressedKey ? 'active' : '';
      tCount++;
    }
  }
}
function create_agi_google_taxonomie(langID, langCode)
{
  var parent = document.getElementById('g_taxonomie_select_'+langID);
  var ul = document.createElement('UL');
  ul.className = 'agi_taxonomie_select';
  parent.appendChild(ul);
  build_taxonomie_list_element(ul, '---', '', langID);
  eval('var g_taxonimie = g_taxonimie_'+langCode);
  if (g_taxonimie.childs)
    build_agi_taxonomie_list(ul, g_taxonimie.childs, langID);
}
function build_agi_taxonomie_list(parent, taxonomie_object, langID)
{
  for (var i in taxonomie_object)
  {
    var li = build_taxonomie_list_element(parent, i, taxonomie_object[i].string, langID);
    li.className = 'agi_taxonomie_li'; // just for IE in Quirksmode
    if (taxonomie_object[i].childs)
    {
      var ul = document.createElement('UL');
      ul.className = 'agi_taxonomie_ul'; // just for IE in Quirksmode
      li.appendChild(ul);
      li.className = 'has_childs';
      li.onmouseover   = new Function('hover_taxonomie_list_element(this)');
      build_agi_taxonomie_list(ul, taxonomie_object[i].childs, langID);
    }
  }
}
function build_taxonomie_list_element(parent, text, value, langID)
{
  var li = document.createElement('LI');
  parent.appendChild(li);
  var span = document.createElement('SPAN');
  span.className = 'agi_taxonomie_span'; // just for IE in Quirksmode
  li.appendChild(span);
  span.appendChild(document.createTextNode(decodeURIComponent(text)));
  span.onclick = new Function ("set_taxonomie_value('"+decodeURIComponent(value)+"',"+langID+")");
  return li;
}
function hover_taxonomie_list_element(me)
{
  var myParent = me.parentNode;
  var lis = myParent.getElementsByTagName('LI');
  for (var i=0; i<lis.length; i++)
  {
    lis[i].className = lis[i].className.replace(new RegExp(" hover\\b"), "");
    lis[i].onmouseover = new Function('hover_taxonomie_list_element(this)');
  }
  me.className+=" hover";
  me.onmouseover = '';
}
function set_taxonomie_value(value, langID)
{
  for (var i=0; i<target_elements.length; i++)
    document.getElementsByName(target_elements[i]+'_'+langID)[0].value = value;
}
/** AGI GOOGLE-XML-EXPORT www.andreas-guder.de **/