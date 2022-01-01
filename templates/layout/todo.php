
<!DOCTYPE html>
<html>
 <head>
  <title>Alhassan Alai Wunpini | TODO CRUD SYSTEM</title>

  <!-- MEta Data -->
  <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <!-- All css files -->
    <?= $this->Html->css(['style', 'metisMenu', 'main','/colors/default']); ?>
    <?= $this->Html->css('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css'); ?>

    <!-- Javascript -->
    <?= $this->Html->script(['tableExport', 'popper.min', 'metisMenu','main', 'jquery-3.4.1.min','jquery.base64','custom',]); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'); ?>
    <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js'); ?>
    <?= $this->Html->script('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'); ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js'); ?>


    <script type="text/javascript">
        // Ajax csrf token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
        }
    });

    // ajax request to save student
    $("#frm-add-event").on("submit", function(){

        var postdata = $("#frm-add-event").serialize();
        $.ajax({
            url: "/ajax-add-event",
            data: postdata,
            type: "JSON",
            method: "post",
            success:function(response){
                
                window.location.href = '/list-students'
            }
        });
    });

    </script>
    <!--Full calendar widget script-->
        <script type="text/javascript">
             $(document).ready(function() {
     var calendar = $('#calendar').fullCalendar({
        Boolean, default: true, 
      editable:true,

      header:{
       left:'prev,next today',
       center:'title',
       right:'month,agendaWeek,agendaDay'
      },
       events: [<?php foreach ($events as $key => $event) { ?>{ id : '<?php echo $event->id; ?>', title : '<?php echo $event->title; ?>', start : '<?php echo $event->start_event; ?>', end : '<?php echo $event->end_event; ?>', }, <?php } ?>],
      selectable:true,
      selectHelper:true,
      select: function(start, end, allDay)
      {
      var title = prompt("Enter Event Title");
      var description = prompt("Enter description"); 
      if(title && description)
      {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
        url:"<?= $this->Url->build(['controller' => 'todo', 'action' => 'insert']); ?>",
        type:"JSON",
        method: "POST",
        data:{title:title, description:description, start:start, end:end},
        headers:{
            'X-CSRF-Token':$('meta[name="csrfToken"]').attr('content')
        },
        })
      }
      },
 
      editable:true,
      eventResize:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"controller/update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
        }
      })
      },
 
      eventDrop:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"controller/update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()
        {
        calendar.fullCalendar('refetchEvents');
        alert("Event Updated");
        }
      });
      },
 
      eventClick:function(event)
      {
      if(confirm("Are you sure you want to remove it?"))
      {
        var id = event.id;
        $.ajax({
        url:"controller/delete.php",
        type:"POST",
        data:{id:id},
        success:function()
        {
          calendar.fullCalendar('refetchEvents');
          alert("Event Removed");
        }
        })
      }
      },
 
    });

  });
        </script>

<!--full calendar end -->
 </head>
 <body class="crm_body_bg">

 <!-- sidebar part here -->
    <?= $this->element('nav'); ?>
<!-- sidebar part end -->

<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
    <div class="container-fluid no-gutters">
       
    </div>
    <!--/ menu  -->

    <?=
    $this->Flash->render(); 
    $this->fetch('content');
     ?>


    <!-- footer part -->
        <?= $this->element('footer'); ?>
    <!-- footer ends -->
</section>
  
  


<!-- main content part end -->

<!--PDF Export Script-->
<script type="text/javascript">
        $("body").on("click", "#btnPdfExport", function () {
            html2canvas($('#eventHistory')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("event-data.pdf");
                }
            });
        });
    </script>
<!--PDF EXport end -->

<!--Export to xml-->
<script type="text/javascript">
        // CSV format
        $("body").on("click", "#exportxml", function () {
         $('#eventHistory').tableExport({type:'xml'});
        });
    </script>


<!-- Filter Script -->
<script type="text/javascript">
      $(document).ready(function(){
        $("#fetchval").on('change', function(){
          var value = $(this).val(); 
          //alert(value); 

          $.ajax({
           url:"controller/fetchfilter.php", 
           type:"POST", 
           data:'request=' + value,
           beforeSend:function(){
             $(".tablecontainer").html("<span>Working...</span>"); 

           },
            success:function(data){
            $('.tablecontainer').html(data); 

            }
          });
        }); 
      });
    </script>

     <!--change status --->
     <script type="text/javascript">
         $( "#tb" ).load("load.php");
            function cc(val)
            {
                var str=val.split(",");
                let recid=str[0];
                let recordval=str[1];
                
                
                $.post("controller/functions.php",{value:recordval,rowid:recid},(data,status)=>{
            $( "#tb" ).load("load.php");
                    //alert(data);
                });
                
            }

            $(document).ready(function(){
                cc(val); 
            });
      
    </script>

   




 </body>
</html>