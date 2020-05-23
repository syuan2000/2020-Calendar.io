    <?php

    if(!session_start()) {
    header("Location: error.php");
    exit;
    }
    // in case the user come in before they login
    $loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
    if (!$loggedIn) {
        echo "<script>alert('You have not logged in yet');</script>";
        echo "<script>location.href='login.php';</script>";
        exit;
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="pop-up-note.css">
    <title>Calendar</title>
      <script src="https://kit.fontawesome.com/e45ac9a14a.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
    </head>
    <!-- When page onload, list on the left side will show the current date of user   -->
  <body onload="current()">
    <div id="current-day-info" class="color">
              <a id="back" href="workshop.php">Home page</a>
      <h1 id="app-name-landscape" class="color default-cusor center">My Calendar</h1>
        <div id="current-day-header"></div>
      <div id="current-day-list">
          <h2 id="cur-day"></h2>
      </div>
        <input id ="edit" type="button" value="save my edits" onclick="saveEdits()">
        <div id="sticker-area">
            <p>== sticker area ==</p>
            <!-- draggable stickers  -->
            <img class="sticker" src="image/sticker-1.png" alt="">
            <img class="sticker" src="image/sticker-2.png" alt="">
            <img class="sticker" src="image/sticker-3.png" alt="">
            <img class="sticker" src="image/sticker-4.png" alt="">
            <img class="sticker" src="image/sticker-5.png" alt="">
            <img class="sticker" src="image/sticker-6.png" alt="">
            <img class="sticker" src="image/sticker-7.png" alt="">
        </div>
      <button id="theme-landscape" class="font button">Change theme</button>
    </div>
      <div id="calendar">
          <!-- ajax load php file  -->
          <button id="info" onclick="info_Box()">Help</button>
      <table>
        <thead class="color">
          <tr>
            <th colspan="7" class="color">
              <p id="cal-year">2020</p>
              <div>
                  <a href="may.php"><i class="fas fa-caret-left icon color"></i></a>
                  <p id="cal-month">June</p>
                <button id="addEvent">Add Event</button>
            </div>
            </th>
          </tr>
          <tr>
            <th class="weekday border-color">SUN</th>
            <th class="weekday border-color">MON</th>
            <th class="weekday border-color">TUE</th>
            <th class="weekday border-color">WED</th>
            <th class="weekday border-color">THU</th>
            <th class="weekday border-color">FRI</th>
            <th class="weekday border-color">SAT</th>
          </tr>
        </thead>
        <tbody id="table-body" class="border-color">
          <tr>
            <td></td>
              <!--add unique onclick event for each day to show the data to list on the left side -->
            <td>1<ul id="1" onclick="show('1')"></ul></td>
            <td>2<ul id="2" onclick="show('2')"></ul></td>
            <td>3<ul id="3" onclick="show('3')"></ul></td>
            <td>4<ul id="4" onclick="show('4')"></ul></td>
            <td>5<ul id="5" onclick="show('5')"></ul></td>
            <td>6<ul id="6" onclick="show('6')"></ul></td>
          </tr>
          <tr>
            <td>7<ul id="7" onclick="show('7')"></ul></td>
            <td>8<ul id="8" onclick="show('8')"></ul></td>
            <td>9<ul id="9" onclick="show('9')"></ul></td>
            <td>10<ul id="10" onclick="show('10')"></ul></td>
            <td>11<ul id="11" onclick="show('11')"></ul></td>
            <td>12<ul id="12" onclick="show('12')"></ul></td>
            <td>13<ul id="13" onclick="show('13')"></ul></td>
          </tr>
          <tr>
            <td>14<ul id="14" onclick="show('14')"></ul></td>
            <td>15<ul id="15" onclick="show('15')"></ul></td>
            <td>16<ul id="16" onclick="show('16')"></ul></td>
            <td>17<ul id="17" onclick="show('17')"></ul></td>
            <td>18<ul id="18" onclick="show('18')"></ul></td>
            <td>19<ul id="19" onclick="show('19')"></ul></td>
            <td>20<ul id="20" onclick="show('20')"></ul></td>
          </tr>
          <tr>
            <td>21<ul id="21" onclick="show('21')"></ul></td>
            <td>22<ul id="22" onclick="show('22')"></ul></td>
            <td>23<ul id="23" onclick="show('23')"></ul></td>
            <td>24<ul id="24" onclick="show('24')"></ul></td>
            <td>25<ul id="25" onclick="show('25')"></ul></td>
            <td>26<ul id="26" onclick="show('26')"></ul></td>
            <td>27<ul id="27" onclick="show('27')"></ul></td>
          </tr>
          <tr>
            <td>28<ul id="28" onclick="show('28')"></ul></td>
            <td>29<ul id="29" onclick="show('29')"></ul></td>
            <td>30<ul id="30" onclick="show('30')"></ul></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td> 
          </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      </div>
      <!-- add event popup box-->
      <div id="myModal" class="modal">
          <div class="modal-content">
              <span class="close">&times;</span>
              <div>
              <form id="form" action="#" method="get">
                  <h4 id="event-header">ADD NEW EVENT</h4>
                  <hr>
                  <ul>
                      <li>
                          <label for="title">Title: </label>
                          <input id="title" type="text" name="title" placeholder="ex: python quiz..." >
                      </li>
                      <li>
                          <label for="type">Type:</label>
                            <select id="type" name="work[]">
                            <option value="">Select Type</option>
                            <option value="assignment">Assignment</option>
                            <option value="test">Quiz/Exam</option>
                            <option value="event">Event</option>
                            <option value="reminder">Reminder</option>
                            </select>
                      </li>
                      <li>
                            <label for="date">Date: </label>
                            <input type="date" id="date" name="date" value="2020-05-08" min="2020-04-01">
                      </li>
                      <li>
                            <label for="time">Time: </label>
                            <input id="time" type="text" name="tme" placeholder="ex: 11:59pm / all day">
                      </li>
                  </ul>
                  <div class="addButton">

                    <button id="add" type="button" onclick="addList()">Add to list</button>
                    <button id="clear" type="button" onclick="clean()">Clear Form</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
      <!-- change theme popup box-->
      <div id="theme" class="modal">
          <div class="modal-content">
              <span class="close">&times;</span>
              <h4 id="theme-header">CHANGE MY THEME</h4>
                  <hr>
              <div id="color-options">
                  <div class="color-option" onclick="update('giraffe')">
                      <div class="color-preview" id="giraffe" style="background-image: url(image/set3.png);"></div>
                      <h5 style="text-decoration: underline">giraffe</h5>
                  </div>
                  <div class="color-option" onclick="update('brown')" >
                      <div class="color-preview" id="brown" style="background-image: url(image/1.png);"></div>
                      <h5>brwondish</h5>
                  </div>
                  <div class="color-option" onclick="update('bread')">
                      <div class="color-preview" id="bread" style="background-image: url(image/bread.png);"></div>
                      <h5>bread</h5>
                  </div>
                  <div class="color-option" onclick="update('leaves')">
                      <div class="color-preview" id="leaves" style="background-image: url(image/leaves.png);"></div>
                      <h5>leaves</h5>
                  </div>
                  <div class="color-option" onclick="update('colorful')">
                      <div class="color-preview" id="colorful" style="background-image: url(image/colorful.png);"></div>
                      <h5>colorful</h5>
                  </div>
                  <div class="color-option" onclick="update('blueDream')">
                      <div class="color-preview" id="blueDream" style="background-image: url(image/blue-dream.png);"></div>
                      <h5>blue dream</h5>
                  </div>
              </div>
          </div>    
    </div>
      <!--help info popup box -->
      <div id="infoBox" class="modal">
          <div class="modal-content">
              <span class="close">&times;</span>
              <div id="box-content">
              </div>
        </div>
      </div>
      <script src="pop-up-note.js"></script>
  </body>
</html>