<style>
@import url('https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
  font-family: 'Josefin Sans', sans-serif;
}

.wrapper{
  position: fixed;
}

.wrapper .sidebar{
  width: 200px;
  height: 60%;
  background: #93C572;
  padding: 30px 0px;
  position: fixed;
}
.wrapper .sidebar ul li{
  padding: 15px;
  border-bottom: 1px solid #bdb8d7;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  border-top: 1px solid rgba(255,255,255,0.05);
}    



.wrapper .sidebar ul li a .fas{
  width: 25px;
}

.wrapper .sidebar ul li:hover{
  background-color: #008000;
}
    
.wrapper .sidebar ul li a{
  color: #fff;
}
 
.wrapper .sidebar .social_media{
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
}

.wrapper .sidebar .social_media a{
  display: block;
  width: 40px;
  background: #594f8d;
  height: 40px;
  line-height: 45px;
  text-align: center;
  margin: 0 5px;
  color: #bdb8d7;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.wrapper .main_content{
  width: 100%;
  margin-left: 200px;
}

.wrapper .main_content .header{
  padding: 20px;
  background: #fff;
  color: #717171;
  border-bottom: 1px solid #e0e4e8;
}

.wrapper .main_content .info{
  margin: 20px;
  color: #717171;
  line-height: 25px;
}

.wrapper .main_content .info div{
  margin-bottom: 20px;
}

@media (max-height: 500px){
  .social_media{
    display: none !important;
  }
}
</style>

<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <ul>
            <li><a href="addanimal.php"><i class="fas fa-home"></i>Add Animal</a></li>
            <li><a href="notifications.php"><i class="fas fa-user"></i>Notifications</a></li>
            <li><a href="dietplans.php"><i class="fas fa-address-card"></i>Diet Plans</a></li>
            <li><a href="charts.php"><i class="fas fa-project-diagram"></i>Charts</a></li>
            <li><a href="reports.php"><i class="fas fa-blog"></i>Reports</a></li>
            <li><a href="medical.php"><i class="fas fa-address-book"></i>Medical Records</a></li>
        </ul> 
    </div>
</div>