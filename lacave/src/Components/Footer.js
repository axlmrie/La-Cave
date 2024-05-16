import {useState} from 'react'
import '../Styles/Footer.css'

function Footer (){
    const [inputValue,setInputValue] = useState('')

    function handleInput(e){
        setInputValue(e.target.value)
    }

    function handleBlur() {
        if(!inputValue.includes('@')){
            alert("attention, il n'y a pas d'@, ceci n'est pas une adresse valide 😥")
        }
    }
    return (
        <footer className='lmj-footer'>
            <div className='lmj-footer-elem'>
                Pour les passioné•e•s de plantes 🌿🌱🌵
            </div>
            <div className='lmj-footer-elem'>Laissez-nous votre mail :</div>
            <input
                placeholder='Entrez votre mail'
                onChange={handleInput}
                value={inputValue}
                onBlur={handleBlur}
                />
        </footer>
    )
}

export default Footer