<div class="admin-home">
    <div class="container group">
        <h1>Admin Control Panel</h1>
        <section>
            <div class="col span_1_of_2">
                <h2>Create Faculty</h2>
                <form>
                    <input type="text" placeholder="First Name"></input>
                    <input type="text" placeholder="Last Name"></input><br><br>
                    <input type="text" placeholder="Email"></input>
                    <input type="text" placeholder="Mobile Number"></input><br><br>
                    <input type="text" placeholder="Username"></input>
                    <input type="text" placeholder="Password"></input><br><br>
                    Branch:&nbsp;
                    <select>
                        <option value="volvo">Mech</option>
                        <option value="saab">Civil</option>
                        <option value="mercedes">EC</option>
                        <option value="audi">CS</option>
                        <option value="audi">Elex</option>
                        <option value="audi">IT</option>
                    </select><br><br>
                    <input type="submit" value="Create"/>
                </form>
            </div>
        </section>
        <section>
            <div class="col span_1_of_2">
                <h2>Delete Faculty</h2>
                <p style="margin: 1% 0; color: gray;">
                    Enter the username of the faculty to be deleted.
                </p>
                <form>
                    <input type="text" placeholder="Username"></input>
                    <input type="submit" value="Delete"/>
                </form>
            </div>
        </section>
    </div>
</div>