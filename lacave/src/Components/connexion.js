import { useState } from 'react'
import '../Styles/connexion.css'
import PhoneSelect from './PhoneSelect';

const caratereSpe=["&","@","#","*","$","£","%","+","=","/",":",".",";","?",",","<",">","§","!","-"] 
const MajLetter=["A","Z","E","R","T","Y","U","I","O","P","Q","S","D","F","G","H","J","K","L","M","W","X","C","V","B","N"]

function validatePassword(password) {
    const lengthRequirement = password.length > 8;
    const specialCharRequirement = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    const uppercaseRequirement = /[A-Z]/.test(password);
  
    return lengthRequirement && specialCharRequirement && uppercaseRequirement;
  }

const Connexion =() =>{

    const [showConnexion,setShowConnexion]= useState(true);
    const [showInscription,setShowInscription] = useState(false);

    const connexion = () =>{
        const mail = document.getElementById("mail").value
        const mdp = document.getElementById('mdp').value
        if(!mail.includes("@") && !mail.includes(".")){
            alert("adresse mail non conforme !")
        }
        console.log(mail,mdp)
    }

    const inscription = () =>{
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
        if(!validatePassword(mdp)&& cmdp!=mdp){
            alert("Mot de passe incorrect")
        }

        console.log(prenom,nom,entirePhoneNumber,mail,mdp,cmdp)
    }

    const show = () =>{
        setShowConnexion(!showConnexion)
        setShowInscription(!showInscription)
    }


    return(
        <>
        {showConnexion && <div className='connexion'>
            <h1>Connexion</h1>
            <div>
                <label htmlFor="mail">E-Mail :</label>
                <input type="text" name="mail" id="mail" required/>
                <label htmlFor="mdp">Mot de Passe :</label>
                <input type="password" name="mdp" id="mdp" required/>
                <button onClick={connexion}>Connexion</button>
                <button onClick={show}>Pas de compte</button>
            </div>
        </div>}{showInscription && <div className='inscription'>
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
            <button onClick={inscription}>Inscription</button>
            <button onClick={show}>Déjà un compte</button>
        </div>
    </div>}</>
    )
}

export default Connexion;