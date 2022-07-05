const image = document.querySelector("#file")
const form = document.querySelector('#profileForm')

image.onchange = () => {
    form.submit()
}