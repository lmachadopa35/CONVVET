const handleHour = (event) => {
    let input = event.target
    input.value = hourMask(input.value)
  }
  
  const hourMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"$1:$2")
    return value
  }

  const handleDay = (event) => {
    let input = event.target
    input.value = dayMask(input.value)
  }
  
  const dayMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"$1/$2")
    value = value.replace(/(\d{2})(\d)/,"$1/$2")
    return value
  }

