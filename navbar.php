<style>
      * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
nav {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  background-color:  #93C572;
  justify-content: space-between;
  overflow: auto;
}
ul li {
  position: relative;
  margin: 0 20px;
  list-style: none;
  display: inline-block;
  padding: 14px;
  font-size: 17px;
}
ul li a{
text-decoration: none; 
cursor: pointer;
color: rgb(255, 255, 255);
}
ul li a:hover {
   background-color: #008000;
}
</style>


<nav>
    <img src="logo.png" width="60px" height="40px" id=logo alt="Logo image" style="margin-left: 10px;" />
      <ul class="navigationbar">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="login.php">Logout</a></li>
      </ul>
</nav>