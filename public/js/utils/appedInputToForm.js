export function appendInputToForm(inputName, labelText, inputType = "text", placeholder) {
  if (!placeholder) placeholder = "Enter your " + labelText.toLowerCase();
  let div = document.createElement('div')
  let label = document.createElement('label')
  let input = document.createElement('input')
  div.className = "form-group"
  label.innerText = labelText
  input.type = inputType
  input.name = inputName
  input.placeholder = placeholder
  input.onkeydown = handleClosure()

  function handleClosure() {
    let id
    return function () {
      if (id) {
        clearInterval(id)
      }
      id = setTimeout(() => {
        validateWhenTyping()
      }, 500)
    }
  }

  input.classList = "form-control"

  let errorDiv = document.createElement("div")
  errorDiv.classList = "mt-2 alert alert-danger"

  div.append(label, input, errorDiv)
  document.querySelector("form").append(div)
  return [div,errorDiv]
}
