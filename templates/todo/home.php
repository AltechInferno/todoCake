<div class="main_content_iner ">
        <div class="container-fluid p-0 ">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">
                                        
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Pending Tasks</p>
                                                <h3><span class="counter"><?php echo $pending; ?></span> </h3>
                                            </div>
                                            <a href="#" class="notification_btn yellow_btn">pending</a>
                                            <div id="bar2" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Completed Tasks</p>
                                                <h3><span class="counter"><?php echo $completed; ?></span> </h3>
                                            </div>
                                            <a href="#" class="notification_btn green_btn">completed</a>
                                            <div id="bar3" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Failed Tasks</p>
                                                <h3><span class="counter"><?php echo $failed; ?></span></h3>
                                            </div>
                                            <a href="#" class="notification_btn danger_btn">failed</a>
                                            <div id="bar4" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Event Creator</h3>
                                </div>
                                <?php
                                    echo $this->Html->link(
                                    'Add Event',
                                    '/add-event',
                                    ['class' => 'btn btn-warning pull-right', 'style' => 'margin-top:-7px']
                                    );
                                    ?>
                            </div>
                        </div>
                        
                        <div class="white_card_body p-0">
                        <div id="calendar"></div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30 QA_section">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">To-Do History</h3>
                                </div>

                                <div id="filters" class="single_wrap_input">
                                    <select name="fetchval" id="fetchval" class="nice_Select2 wide">
                                      <option value="" disabled="" selected="">Select Filter</option>
                                      <option value="failed">Failed</option>
                                      <option value="pending">Pending</option>
                                      <option value="completed">Completed</option>
                                    </select>
                                </div>

                                <div>
                                  <input type="submit" class="btn btn-info" id="btnPdfExport" value="Export PDF" />

                                  <button class="btn btn-info" id="exportxml">Export XML</button>
                                </div>
                               
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_table table-responsive tablecontainer">
                                <!-- table-responsive -->
                                <table class="table pt-0" id='eventHistory'>
                                    <thead>
                                        <tr>
                                            <th scope="col">Event Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Start Date/Time</th>
                                            <th scope="col">End Date/Time</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb">
                                        <?php foreach ($events as $key => $event): ?>
                                    <tr>
                                 <td><?= $event->title; ?></td>
                                 <td class="nowrap"><?= $event->description; ?></td>
                                  <td><?= $event->status; ?></td>
                                  <td><?= $event->start_event; ?></td>
                                  <td><?= $event->end_event; ?></td>
                                   <td>
                                   <select name="changestatus" id="changestatus" class="nice_Select2 wide" data-rowId="'.$main_id.'">
                                   <option value="" disabled="" selected="">Change Status</option>
                                   <option value="failed">Failed</option>
                                   <option value="pending">Pending</option>
                                   <option value="completed">Completed</option>
                                 </select>
                                   </td>
                                    </tr>
                                        <?php endforeach; ?>
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>