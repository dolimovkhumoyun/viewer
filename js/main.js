/*  *************** Dolimov Khumoyunmirzo  ***************  */

var timeline;
var ip_clicked;

// ******* Calerndar JQuery Scripts ********
$(document).ready(function() {
  var video = document.getElementById("video");
  // Initializes Zabuto Calendar Plugin
  $("#my-calendar").zabuto_calendar({
    action: function() {
      var date = $("#" + this.id).data("date");
      if ($("#visualization div").hasClass("vis-timeline")) {
        $("#visualization").empty();
      }
                 
      video.src = " ";
      return showIpList(date);
    },
    language: "en",
    today: true,
    nav_icon: {
      prev: '<i class="fa fa-chevron-circle-left "></i>',
      next: '<i class="fa fa-chevron-circle-right"></i>'
    },
    ajax: {
      url: "ajax.php"
    }
  });

  // When the Video Ends, it display following video
  $('#video').on('ended',function(e){       
      data_id = timeline.getSelection();      
      next_id = data_id[0];

      if (timeline.itemsData._data[next_id + 1] != null) {
        current_time = timeline.itemsData._data[next_id].start;
        next_time = timeline.itemsData._data[next_id+1].start;
        difference = time_diff(next_time,current_time);

        if(difference < 130000 && difference > 0){
          let next_dest = dest_maker(ip_clicked, next_time);
          video.src = next_dest;
          video.play();
          timeline.setSelection(++next_id, {focus: focus.checked});
        }
      }
  });

});

// After click on Calendar Shows LIst of IPs
function showIpList(date) {
  $.ajax({
    type: "POST",
    url: "show_ipList.php",
    dataType: "JSON",
    data: { date: date },
    cache: false,
    beforeSend: function(ip_list) {
      $("#lists").html('<img id="lists_loading" src="loading.svg"  />');
    },

    success: function(ip_list) {
      var ip_html = '<ul class="list-group ipList" id="ulList">';

      for (var i = 0; i <= ip_list.length - 1; i++) {
        ip_html += '<li class="list-group-item col-10">' + ip_list[i] + "</li>";
      }
      ip_html += "</ul>";

      $(".div_list")
        .html(ip_html)
        .animate(500);

      $("#ulList li").click(function() {
        var index = $(this).index();
        var ip = $(this).text();

        $(".list-group li.active").removeClass("active");
        $(this).addClass("active");
        video = document.getElementById("video");
        if(video.length)
            video.src = "";

        return show_tracker(ip, date);
      });
    }
  });
}

//   Showing The Tracker on Select of IP
function show_tracker(ip, date) {
  let ip_current = ip;
  $.ajax({
    type: "POST",
    url: "item_list.php",
    dataType: "JSON",
    cache: false,
    data: { date: date, ip: ip },
    ip: ip_current,
    beforeSend: function() {
      if ($("#visualization div").hasClass("vis-timeline")) {
        $("#visualization").empty();
      }
      $("#visualization").html('<img id="loader_image" src="loading.svg"  />');
      // alert("hello");
    },
    success: function(data) {
      // Hiding the loader *****
      $("#loader_image").hide();

      // DOM element where the Timeline will be attached
      let container = document.getElementById("visualization");
      ip_clicked = this.ip.replace(/\s\.\s/g, "_");
      // Create a DataSet (allows two way data-binding)
      items = new vis.DataSet(data);
      // Configuration for the Timeline
      let options = {};

      // Create a timeline
      timeline = new vis.Timeline(container, items, options);
   
      timeline.on("select", function(properties) {
          id = timeline.getSelection();
          current_id = id[0];       
          
          if (timeline.itemsData._data[current_id] != null) {
            time = timeline.itemsData._data[current_id].start;
            let dest = dest_maker(ip_clicked, time);          
            video.src = dest;
          }
       });
    },
    error: function(e, ts, et) {
      alert(e);
    }
  });
}

    

function time_diff(t2, t1) {
  let date_next = new Date(t2);
  let date_current = new Date(t1);
  let diff = date_next - date_current;
  return diff;
}

//  Can Accept Example: datetime: 2019-04-14T18:03:06
function dest_maker(ip_clicked, datetime) {
  let dest;
  if (datetime != null && ip_clicked != null) {
    datetime = datetime.split("T");
    let date = datetime[0]; // Stores date : 2019-04-14
    date = date.split("-"); // Splits date : 2019-04-14  -->  date : 2019 04 14

    let year = date[0];
    let month = date[1];
    let day = date[2];

    let time = datetime[1]; // Stores time : 18:03:06

    time = time.replace(/\:/g, "_"); // Converts 18:03:06  --> 18_03_06

    let video_name = "i" + ip_clicked + "T" + time + ".mp4";

    dest = "video/y" + year + "/m" + month + "/d" + day + "/" + video_name;
  }
  return dest;
}