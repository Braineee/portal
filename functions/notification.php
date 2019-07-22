<?php
if (Session::exists('error')) {
    echo "<div class='alert alert-dismissable alert-danger'>
             <img src='assets/img/svg/cancel.svg' width='20px'>&ensp;<strong>". Session::flash('error') . "</strong>
        </div>";
}
if (Session::exists('info')) {
    echo "<div class='alert alert-dismissable alert-warning'>
            <img src='assets/img/svg/warning.svg' width='20px'>&ensp;<strong>". Session::flash('info') . "</strong>
        </div>";
}
if (Session::exists('success')) {
    echo "<div class='alert alert-dismissable alert-success'>
            <img src='assets/img/svg/success.svg' width='20px'>&ensp;<strong>". Session::flash('success') . "</strong>
        </div>";
}
