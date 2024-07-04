import '../Styles/Banner.css'
import logo from '../Assets/logo.png'


function Banner ({itemCount}){

    const redirect =()=>{
        console.log(sessionStorage)
        if(sessionStorage.getItem("Connected") === "true"){
            window.location.href="/boutique/profil"
        }else{
        window.location.href = "/connexion"}
    }

    const display = () =>{
        const cart = document.getElementById('cart')
        if(cart.style.display === "none"){
            cart.style.display = "flex"
        }else{
            cart.style.display = "none"
        }
        
    }


    return (
    <div className="lmj-banner">
        <div className='logo'>
        <img src={logo} alt='La maison jungle' className='lmj-logo'/>
        <h1>La Cave</h1>
        </div>
        <div className='rightBanner'>
            <div className='account' onClick={display}>
                <svg xmlns="http://www.w3.org/2000/svg" 
                height="36px" viewBox="0 -960 960 960"
                 width="48px" fill="#e8eaed" className="cart-icon">
                    <path d="M220-80q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h110v-10q0-63 43.5-106.5T480-880q63 0 106.5 43.5T630-730v10h110q24 0 42 18t18 42v520q0 24-18 42t-42 18H220Zm0-60h520v-520H630v90q0 12.75-8.68 21.37-8.67 8.63-21.5 8.63-12.82 0-21.32-8.63-8.5-8.62-8.5-21.37v-90H390v90q0 12.75-8.68 21.37-8.67 8.63-21.5 8.63-12.82 0-21.32-8.63-8.5-8.62-8.5-21.37v-90H220v520Zm170-580h180v-10q0-38-26-64t-64-26q-38 0-64 26t-26 64v10ZM220-140v-520 520Z"/>
                    </svg>{itemCount > 0 && (
                <span className="badge">{itemCount}</span>)}
            </div>
            <div className='account' onClick={redirect}><svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="48px" fill="#e8eaed"><path d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.81-195q-57.81 0-97.31-39.69-39.5-39.68-39.5-97.5 0-57.81 39.69-97.31 39.68-39.5 97.5-39.5 57.81 0 97.31 39.69 39.5 39.68 39.5 97.5 0 57.81-39.69 97.31-39.68 39.5-97.5 39.5Zm.66 370Q398-80 325-111.5t-127.5-86q-54.5-54.5-86-127.27Q80-397.53 80-480.27 80-563 111.5-635.5q31.5-72.5 86-127t127.27-86q72.76-31.5 155.5-31.5 82.73 0 155.23 31.5 72.5 31.5 127 86t86 127.03q31.5 72.53 31.5 155T848.5-325q-31.5 73-86 127.5t-127.03 86Q562.94-80 480.47-80Zm-.47-60q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z"/></svg></div>
        </div>
        </div>)
}

export default Banner