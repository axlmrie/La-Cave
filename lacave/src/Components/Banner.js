import '../Styles/Banner.css'
import logo from '../Assets/logo.png'

function Banner (){
    return (
    <div className="lmj-banner">
        <div className='logo'>
        <img src={logo} alt='La maison jungle' className='lmj-logo'/>
        <h1>La Cave</h1>
        </div>
        <div>
            <button>Se connecter/S'incrire</button>
        </div>
        </div>)
}

export default Banner