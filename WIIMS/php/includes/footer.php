        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="copyright text-center">
                    <span>Copyright &copy; Baker's Craft 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
        </main>
        <!--modals-->
        <!--account modal-->
        <div id = "accountModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Settings</h5>
                        <button class="close" type="button">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-message">
                            <form>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "username">Username:</label>
                                    </div>
                                    <div class="input">
                                        <input type="text" id="pcode" name = "pcode">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "pword">Password:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="pname" name = "pword-confirm">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for ="empName">Name:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="firstname" name = "firstName" class = short> <input type ="text" id="middleini" name = "middileIni" class = shortest> <input type ="text" id="lastname" name = "lastName" class = short>
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "sex">Sex:</label>
                                    </div>
                                    <div class="input">
                                        <Select id="sex" name = "Sex">
                                            <option value = "Male" > Male </option>
                                            <option value = "Female" > Female </option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "capacity">Birthday:</label>
                                    </div>                              
                                    <div class="input">                               
                                        <input type ="text" id="capacity" name = "capacity"> 
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "color">Email:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="color" name = "color">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "price">Contact No.:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="price" nmae = "price">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "price">User Image:</label>
                                    </div>
                                    <div class="input">
                                        <input type = "file" name = "upload_img" id = "upload_img">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" type="button">Cancel</button>
                        <a class="btn-confirm" href="">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
        <!--account modal end-->
            <!--logout modal-->
            <div id = "logoutModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ready to Leave?</h5>
                            <button class="close" type="button">
                                <span>×</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-message">
                                Select "Logout" below if you are ready to end your current session.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-cancel" type="button">Cancel</button>
                            <a class="btn-confirm" href="logout.php"> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--logout modal end-->
        <!--End modals-->
    </div>
</body>
</html>