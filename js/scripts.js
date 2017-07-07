// setup buttons
$("#pager-prev").click(function(){
    var getType = $(this).data("type");
    var getCount = $(this).data("count");
    var getToken = $(this).data("token");
    var getKeyword = $(this).data("keyword");
    fetchList(getType, getCount, getToken,'', getKeyword);
});

$("#pager-next").click(function(){
    var getType = $(this).data("type");
    var getCount = $(this).data("count");
    var getToken = $(this).data("token");
    var getKeyword = $(this).data("keyword");
    fetchList(getType, getCount, '', getToken, getKeyword);
});

// search
$("#search-submit").click(function(){
    var getKeyword = $("#search-keyword").val();
    // do search
    fetchList("search",'','','',getKeyword);
});

// fetch
function fetchList(getType, getCount, getPrev, getNext, getKeyword){

  var listBody      = $("#list-body");
  var listBodyItem  = $("#list-body-item");
  var pagerPrev     = $("#pager-prev");
  var pagerNext     = $("#pager-next");
  var loadingDialog = $("#loading-dialog");

  // active tag
  $(".control-tag").removeClass("active");

  if(getType == "hot"){
      $("#hot-btn").addClass("active");
  }else if(getType == "new"){
      $("#new-btn").addClass("active");
  }

  // show dialog
  loadingDialog.show();

  // clear content
  listBody.empty();

  // clear keyword
  if(getKeyword == null || getKeyword == ''){
      $("#search-keyword").val("");
  }

  // hide buttons
  pagerPrev.css("display", "none");
  pagerNext.css("display", "none");

  if(getType != null){
    // send data
    $.post( "./api/GetFeeds.php", {type: getType, 
                                  count: getCount, 
                                  prev: getPrev, 
                                  next: getNext, 
                                  keyword: getKeyword})
      .done(function( data ) {

        // hide dialog
        loadingDialog.hide();

        if(data.StatusCode == "200"){

          if(data.List.length > 0){
            // list item
            $.each(data.List, function(key, row){

                var tmpItem = listBodyItem.clone();
                tmpItem.append(row.title);
                tmpItem.attr("href", row.url);
                tmpItem.children("span").html(row.time);
                tmpItem.removeAttr("id");

                // insert data into body
                listBody.append(tmpItem);

            });

            // update pager item
            if(data.Next != null){
                var getNextToken = data.Next;
                var getNextCount = getCount + 25;

                pagerNext.css("display", "inline");
                pagerNext.attr("data-type", getType);
                pagerNext.attr("data-count", getNextCount);
                pagerNext.attr("data-token", getNextToken);

                if(getKeyword != null){
                  pagerNext.attr("data-keyword", getKeyword);
                }
            }

            if(data.Prev != null){
                var getPrevToken = data.Prev;
                var getPrevCount = getCount +1;

                pagerPrev.css("display", "inline");
                pagerPrev.attr("data-type", getType);
                pagerPrev.attr("data-count", getPrevCount);
                pagerPrev.attr("data-token", getPrevToken);

                if(getKeyword != null){
                  pagerPrev.attr("data-keyword", getKeyword);
                }
            }
          }else{
            alert("No results");
          }
        }else{
          alert("Fetch Error!");
        }

    });
  }
}