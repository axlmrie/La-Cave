import { useState } from 'react'
import '../../Styles/connexion.css'
import PhoneSelect from './PhoneSelect';
import logo from '../../Assets/logo.png'
import bg from '../../Assets/wineCave.webp'

function validatePassword(password) {
    const lengthRequirement = password.length >= 8;
    const specialCharRequirement = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    const uppercaseRequirement = /[A-Z]/.test(password);
  
    return lengthRequirement && specialCharRequirement && uppercaseRequirement;
  }

  

const Connexion =() =>{
    document.documentElement.style.backgroundImage=`url(${bg})`
    document.documentElement.style.backgroundSize="cover"

    const [showConnexion,setShowConnexion]= useState(true);
    const [showInscription,setShowInscription] = useState(false);

    const connexion = async () => {
        const email = document.getElementById("mail").value;
        const mdp = document.getElementById('mdp').value;
        if (!email.includes("@") || !email.includes(".")) {
            alert("Adresse mail non conforme !");
            return;
        }

        const sendData = JSON.stringify({ email : email, password: mdp })
        try {
            const response = await fetch("http://localhost:8080/clients/login", {
                method: 'POST',
                cache:"no-cache",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: sendData
            });
            const data = await response.json();
            console.log(data)
            if (data.idClient !== undefined) {
                console.log(data)
                sessionStorage.clear();
                sessionStorage.setItem("identifiant", data.idClient);
                sessionStorage.setItem("Connected", true);
                sessionStorage.setItem("session", true);
                window.location.href = "/boutique";
            } else {
                alert("Erreur lors de l'inscription");
                sessionStorage.setItem("session",false);
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite. Veuillez réessayer.");
        }
    };

    const inscription = async () =>{
        const prenom = document.getElementById("prenom").value
        const nom = document.getElementById("nom").value
        const indicatif = document.getElementById("value").textContent
        const phone = document.getElementById("phone").value
        const entirePhoneNumber = indicatif+phone
        const mail = document.getElementById("mail").value
        const mdp = document.getElementById('mdp').value
        const cmdp = document.getElementById("cmdp").value
        if(!mail.includes("@")&& !mail.includes(".")){
            alert("adresse mail non conforme !")
        }
        if(!validatePassword(mdp)&& cmdp!==mdp){
            alert("Mot de passe incorrect")
        }

        const sendData = JSON.stringify({prenom:prenom,nom:nom,numero_tel:entirePhoneNumber,mail:mail,password:mdp})
        try {
            const response = await fetch("http://localhost:8080/clients/create", {
                method: 'POST',
                cache:"no-cache",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: sendData
            });
            const data = await response.json();
            console.log(data)
            if (data.idClient !== undefined) {
                sessionStorage.clear();
                sessionStorage.setItem("identifiant", data.idClient);
                sessionStorage.setItem("Connected", true);
                sessionStorage.setItem("session", 'true');
                window.location.href = "/boutique";
            } else {
                alert("Erreur lors de l'inscription");
                sessionStorage.setItem("session", "false");
            }
            

    } catch (error) {
        console.error('Erreur:', error);
        alert("Une erreur s'est produite. Veuillez réessayer.");
    }}

    const show = () =>{
        setShowConnexion(!showConnexion)
        setShowInscription(!showInscription)
    }


    return(
        <>
        {showConnexion && <div className='connexion'>
        <img src={logo} alt='La maison jungle' className='lmj-logo'/>
            <h1>Connexion</h1>
            <div className='form'>
                <label htmlFor="mail">E-Mail :</label>
                <input type="text" name="mail" id="mail" required/>
                <label htmlFor="mdp">Mot de Passe :</label>
                <input type="password" name="mdp" id="mdp" required/>
                <div className='btn'>
                <button onClick={connexion}>Connexion</button>
                <button onClick={show}>Pas de compte</button>
                </div>
            </div>
        </div>
        }
        {showInscription && 
        <div className='inscription'>
            <img src={logo} alt='La maison jungle' className='lmj-logo'/>
        <h1>Inscription</h1>
        <div className='InsDiv'>
            <label htmlFor="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required/>
            <label htmlFor="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required/>
            <label htmlFor="tel">Numéro de téléphone :</label>
            <div>
                <PhoneSelect />
            </div>
            <label htmlFor="mail">E-Mail :</label>
            <input type="text" name="mail" id="mail" required/>
            <label htmlFor="mdp">Mot de Passe :</label>
            <input type="password" name="mdp" id="mdp" required/>
            <label htmlFor="cmdp">Confirmation de mot de Passe :</label>
            <input type="password" name="cmdp" id="cmdp" required/>
            <div className='btn'>
            <button onClick={inscription}>Inscription</button>
            <button onClick={show}>Déjà un compte</button>
            </div>
        </div>
    </div>}</>
    )
}

export default Connexion;