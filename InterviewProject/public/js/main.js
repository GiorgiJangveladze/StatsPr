//  For ajax request on delete click - currently this function init X-CSRF-TOKEN for avoid error in future ))
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// Asynchrone delete column from table
function deletefunction(methodname,object) {        

    let id = $(object).attr("rel");
    alertify.confirm("Delete ?", function (e) {

        if (e) {
                $.ajax({
                    type: "get",
                    url: methodname, 
                    data: {id:id},
                    complete:function(data)
                    {
                        console.log(data.responseJSON.status);
                        if(data.status) {
                            alertify.alert(data.responseJSON.msg);
                            $(object).closest('tr').remove();
                        }else{
                          alertify.alert(data.responseJSON.msg);
                        }
                    }
                });

        } else {
            return false; 
        }
    });
}

// This one need for change in url sortBy attribute becouse when user use pagination we will lost sortBy attr withour search click
// function replaceUrlParam(url, paramName, paramValue)
// {
//     if (paramValue == null) {
//         paramValue = '';
//     }
//     var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
//     if (url.search(pattern)>=0) {
//         return url.replace(pattern,'$1' + paramValue + '$2');
//     }
//     url = url.replace(/[?#]$/,'');
//     return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
// }


// SImple sortable by row  (i doesn't has time fox optimization of Front-side and i think its not a problem because main focuse of task are only back-end)
function sortTable(n) {
  var table,
    arrow,
    input,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;
  
  table = document.getElementById("myTable");
  input = document.getElementById("sortedBy");
  arrow = document.getElementById("arrow-symbol-" + n);
  if(parseInt(input.value) === n) {
    input.value = '';
    arrow.innerHTML = "&#8595";
  }else {
    input.value = n;
    arrow.innerHTML = "&#8593";
  }

  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < rows.length - 1; i++) { //Change i=0 if you have the header th a separate table.
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}


// Custom Modal
function openModal () {
  $('.dimmer').fadeIn(function () {
    $('.modal').fadeIn();
  });
}
$(document).ready(function() {
  $(document).delegate('body', 'click', function(event) {
    $('.modal').fadeOut(function () {
      $('.dimmer').fadeOut();
    });
  });
  $(document).delegate('button', 'click', function(event) {
    event.stopPropagation();
  });
});