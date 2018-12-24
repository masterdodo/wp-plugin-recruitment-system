function AddVehicle()
{
	var ExistingSelect = document.querySelector('select[name=vehicle1a]')
	var cloneSelect = ExistingSelect.cloneNode(true)
	var SelectLength = document.querySelectorAll('.vehicles select').length
	SelectLength += 2
	var Lock = SelectLength - 1
	var SelectName = 'select[name=vehicle' + Lock + 'a]'
    var LockSelect = document.querySelector(SelectName)
    if(LockSelect.value != "")
    {
		//LockSelect.blur = true
		//
		SelectedValue = LockSelect.value
		//console.log(SelectedValue + 'A')
		AllOptionsOfLockSelect = LockSelect.children
		for(var i = 0; i < AllOptionsOfLockSelect.length; i++)
		{
			if(AllOptionsOfLockSelect[i].value != SelectedValue)
			{
				AllOptionsOfLockSelect[i].style.display = 'none'
			}
		}
		//
	    var vehicleNumber = 'vehicle' + SelectLength + 'a'
	    cloneSelect.setAttribute('name',vehicleNumber)
	    cloneSelect.disabled = false
	    var newDiv = document.createElement('div')
	    newDiv.setAttribute('class','vehicles')
	    newDiv.appendChild(cloneSelect)
	    var divBefore = document.querySelector('#driving_categories')
	    parentNode = divBefore.parentNode
        parentNode.insertBefore(newDiv, divBefore)
    }
}