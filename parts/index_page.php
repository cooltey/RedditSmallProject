<?php
 /**
 *  Project: Reddit API small project
 *  Last Modified Date: 2017 July
 *  Developer: Cooltey Feng
 *  File: parts/login_page.php
 *  Description: Login Page
 */

?>


    <div class="container">
      <!-- Example row of columns -->
      <div class="row">

        <div class="col-md-12">

          <div class="space-100"></div>
          <!-- List Content -->
          <div class="row">
           <div class="col-md-12">
              <!-- Control Buttons -->
              <div class="navbar">
                <ul class="navbar-form navbar-left">
                  <button type="button" class="control-tag btn btn-success" onclick="fetchList('hot', '', '', '', '');" id="hot-btn">Hot</button>
                  <button type="button" class="control-tag btn btn-success" onclick="fetchList('new', '', '', '', '');" id="new-btn">New</button>
                </ul>
                <div class="navbar-form navbar-right">
                  <div class="form-group">
                  <input type="text" class="form-control" placeholder="Keywords" value="" name="keyword" id="search-keyword">
                  </div>
                  <button type="button" class="btn btn-primary" id="search-submit">Search</button>
                </div>
              </div>

              <!-- List Zone-->
              <div class="panel panel-default">
                <span class="label label-warning" id="loading-dialog">Loading</span>
                <div class="list-group" id="list-body">
                </div>
              </div>
              <a class="list-group-item" id="list-body-item" target="_blank"><span class="badge"></span></a>
           </div>
            <nav aria-label="Pager">
              <ul class="pager">
                <li><a href="#prev" id="pager-prev">Previous</a></li>
                <li><a href="#next" id="pager-next">Next</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>