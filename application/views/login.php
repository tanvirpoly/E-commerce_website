<?php $this->load->view('header/header'); ?>
<style>
body {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Montserrat", sans-serif;
    font-size: 12px;
    background-color: #ecf0f3;
    color: #a0a5a8;
}

/**/
.main {
    position: relative;
    width: 900px;
    min-width: 900px;
    min-height: 500px;
    height: 500px;
    padding: 25px;
    background-color: #ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6, -10px -10px 10px #f9f9f9;
    border-radius: 12px;
    overflow: hidden;
    margin-top: 50px;
}

@media (max-width: 1200px) {
    .main {
        transform: scale(0.7);
    }
}

@media (max-width: 1000px) {
    .main {
        transform: scale(0.6);
    }
}

@media (max-width: 800px) {
    /*.main {*/
    /*    transform: scale(0.5);*/
    /*}*/
    #switch-cnt{
        display:none;
    }
    #b-container{
        
    }
}

@media (max-width: 600px) {
    /*.main {*/
    /*    transform: scale(0.4);*/
    /*}*/
    
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    width: 600px;
    height: 100%;
    padding: 25px;
    background-color: #ecf0f3;
    transition: 1.25s;
}

.form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
    height: 100%;
}

.form__icon {
    object-fit: contain;
    width: 30px;
    margin: 0 5px;
    opacity: 0.5;
    transition: 0.15s;
}

.form__icon:hover {
    opacity: 1;
    transition: 0.15s;
    cursor: pointer;
}

.form__input {
    width: 350px;
    height: 40px;
    margin: 4px 0;
    padding-left: 25px;
    font-size: 13px;
    letter-spacing: 0.15px;
    border: none;
    outline: none;
    font-family: "Montserrat", sans-serif;
    background-color: #ecf0f3;
    transition: 0.25s ease;
    border-radius: 8px;
    box-shadow: inset 2px 2px 4px #d1d9e6, inset -2px -2px 4px #f9f9f9;
}

.form__input:focus {
    box-shadow: inset 4px 4px 4px #d1d9e6, inset -4px -4px 4px #f9f9f9;
}

.form__span {
    margin-top: 30px;
    margin-bottom: 12px;
}

.form__link {
    color: #181818;
    font-size: 15px;
    margin-top: 25px;
    border-bottom: 1px solid #a0a5a8;
    line-height: 2;
}

.title {
    font-size: 34px;
    font-weight: 700;
    line-height: 3;
    color: #181818;
}

.description {
    font-size: 14px;
    letter-spacing: 0.25px;
    text-align: center;
    line-height: 1.6;
}

.button {
    width: 180px;
    height: 50px;
    border-radius: 25px;
    margin-top: 50px;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1.15px;
    background-color: #4b70e2;
    color: #f9f9f9;
    box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #f9f9f9;
    border: none;
    outline: none;
}

/**/
.a-container {
    z-index: 100;
    left: calc(100% - 600px);
}

.b-container {
    left: calc(100% - 555px);
    z-index: 0;
}

.switch {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 400px;
    padding: 50px;
    z-index: 200;
    transition: 1.25s;
    background-color: #ecf0f3;
    overflow: hidden;
    box-shadow: 4px 4px 10px #d1d9e6, -4px -4px 10px #f9f9f9;
}

.switch__circle {
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background-color: #ecf0f3;
    box-shadow: inset 8px 8px 12px #d1d9e6, inset -8px -8px 12px #f9f9f9;
    bottom: -60%;
    left: -60%;
    transition: 1.25s;
}

.switch__circle--t {
    top: -30%;
    left: 60%;
    width: 300px;
    height: 300px;
}

.switch__container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    position: absolute;
    width: 400px;
    padding: 50px 55px;
    transition: 1.25s;
}

.switch__button {
    cursor: pointer;
}

.switch__button:hover {
    box-shadow: 6px 6px 10px #d1d9e6, -6px -6px 10px #f9f9f9;
    transform: scale(0.985);
    transition: 0.25s;
}

.switch__button:active,
.switch__button:focus {
    box-shadow: 2px 2px 6px #d1d9e6, -2px -2px 6px #f9f9f9;
    transform: scale(0.97);
    transition: 0.25s;
}

/**/
.is-txr {
    left: calc(100% - 400px);
    transition: 1.25s;
    transform-origin: left;
}

.is-txl {
    left: 0;
    transition: 1.25s;
    transform-origin: right;
}

.is-z200 {
    z-index: 200;
    transition: 1.25s;
}

.is-hidden {
    visibility: hidden;
    opacity: 0;
    position: absolute;
    transition: 1.25s;
}

.is-gx {
    animation: is-gx 1.25s;
}

@keyframes is-gx {

    0%,
    10%,
    100% {
        width: 400px;
    }

    30%,
    50% {
        width: 500px;
    }
}
.link:hover{
    color:#fd7e14;
    font-weight:bold;
    transition: 0.25s;
    cursor:pointer;
}
</style>

<body>
    <div class="main ">
        
            
            <div class="container b-container" id="b-container">
            <form class="form" id="b-form" action="<?php echo base_url('Login/loginProcess'); ?>" method="post">
                <h2 class="form_title title">Sign in to Software</h2>
                <label style="color:black;font-size:.9rem;">Email / Username <i class="fa fa-user"></i></label>
                <input class="form__input" type="text" name="username" id="user" placeholder="Email or Username">
                <label style="color:black;font-size:.9rem;">Password <i class="fa fa-key"></i></label>
                <input class="form__input" type="password" name="password" id="ps" placeholder="Password">
                <button class="form__button button submit">SIGN IN</button><br>
                <?php
             $query=$this->db->select('password')
                             ->from('users')
                             ->where('userrole',2)
                             ->get()
                             ->row();
           
            ?>
                <!--<div class="">-->
                <!--    <table class="table table-striped table-bordered" style="color:black;">-->
                <!--        <thead>-->
                <!--            <th>Role</th>-->
                <!--            <th>Username</th>-->
                <!--            <th>Password</th>-->
                <!--        </thead>-->
                <!--        <tbody style="text-align:center;">-->
                <!--            <tr onClick=adminfill() class="role link" >-->
                <!--                <td><b>Admin</b></td>-->
                <!--                <td id="username">admin</td>-->
                <!--                <td id="pass"><?php echo ($query->password); ?></td>-->
                <!--            </tr>-->
                <!--        </tbody>-->
                <!--    </table>-->
                <!--</div>-->
            </form>
        </div>
        
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h3 class="switch__title title">Welcome</h3>
                <?php $company = $this->db->select("*")->FROM('com_profile')->WHERE('com_pid',1)->get()->row(); ?>
                <img src="<?php echo base_url().'upload/company/'.$company->com_logo; ?>"
                    style="height: auto; width: 100%;">
                
          

            </div>
        </div>
            

        

        


    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <script type="text/javascript">
        function adminfill() {
            // alert("hi");
                document.getElementById("user").value = document.getElementById("username").innerHTML;
                document.getElementById("ps").value = document.getElementById("pass").innerHTML;
                document.forms[0].submit()
            // alert(user.innerHTML);
            // document.getElementById("submit").click();
        }
        
    </script>
</body>

</html>