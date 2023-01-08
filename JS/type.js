function TYPE(value){

    	var date = new Date();
        var currentDate = date.toISOString().slice(0,10);
        document.getElementById('date').value = currentDate;

	var type = ['expense','income'];
	var exp ='<select id="category" class="form-control-1" name="category"> <option value="" disabled selected>Select Expense</option> <option id="2" selected>Food And Dining</option> <option id="3">Shopping</option> <option id="4">Travelling</option> <option id="5">Entertainment</option> <option id="6">Medical</option> <option id="7">Personal Care</option> <option id="8">Education</option> <option id="9">Bills And Utillities</option> <option id="10">Investment</option> <option id="11">Rent</option> <option id="12">Taxes</option> <option id="13">Insurance</option> <option id="14">Gift And Donation</option> </select>';
	var inc ='<select id="category" class="form-control-1" name="category"> <option value="" disabled selected>Select Income</option> <option id="16" selected>Salary</option><option id="17">Sold Items</option> <option id="18">Coupons</option> <option id="19">Pocket Money</option> </select>';
	var cat =[exp,inc];
	for (var i = 0; i < 2; i++) 
	{
		if(type[i]==value)
		{
			document.getElementById('demo').innerHTML=cat[i];
			document.getElementById(type[i]).style.backgroundColor='darkgray';
			document.getElementById(type[i]).style.color='white';
		}
		else{
			document.getElementById(type[i]).style.backgroundColor='';
			document.getElementById(type[i]).style.color='black';
		}
	}
}