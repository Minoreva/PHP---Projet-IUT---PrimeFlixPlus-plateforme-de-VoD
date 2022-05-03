				<section>
				<h3>Sign up :</h3>
				<p>Fill the form with your informations</p>
					<form method="post" action="index.php">
					<div>
						<label>Firstname :</label>
						<input type="text" name="firstname" placeholder="John">
					</div>
					<div>
						<label>Lastname : </label>
						<input type="text" name="lastname" placeholder="117">
					</div>
					<div>
						<label>E-mail : </label>
						<input type="email" name="email" placeholder="example@example.com">
					</div>
					<div>
						<label>Password :</label>
						<input type="password" name="password" placeholder="Password">
					</div>	
					<input type="submit" name="btnValiderInscr" value="Send now"></button>
					</form>
                                        <strong><?= $message ?></strong>
				</section>