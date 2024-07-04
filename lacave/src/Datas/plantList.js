import digestif from '../Assets/digestif.jpg';
import vin_rosé from '../Assets/vinRose.jpg';
import champagne from '../Assets/champagne.jpg';
import vin_rouge from '../Assets/vinRouge.jpg';
import vin_blanc from '../Assets/vinBlanc.jpg';
import vin_pétillant from '../Assets/vinPetillant.jpg'; // Vérifiez que cette image existe



const imageMapping = {
    "digestif": digestif,
    "vin rosé": vin_rosé,
    "champagne": champagne,
    "vin rouge": vin_rouge,
    "vin blanc": vin_blanc,
    "vin pétillant": vin_pétillant
    // Ajoutez d'autres mappings si nécessaire
};

export const plantList = [];

export const creaVinList = () => {
    return fetch('http://localhost:8080/articles/FindAll')
        .then(response => response.json())
        .then(data => {
            data.forEach(element => {
                const imageName = imageMapping[element.famille.cepage];
                if (!imageName) {
                    console.warn(`No image found for cépage: ${element.famille.cepage}`);
                }
                plantList.push({
                    name: element.designation,
                    category: element.famille.cepage,
                    id: element.idArticle,
                    idFournisseur : element.famille.idFamille,
                    price: element.prix,
                    stock: element.stock,
                    reference: element.reference,
                    conditionnement: element.conditionnement,
                    cover:imageName,
                    vignoble : element.famille.vignoble,
                    annee:element.famille.annee,
                    // Vous pouvez ajuster cette ligne pour des images dynamiques si nécessaire
                });
            });
        })
        .catch(error => {
            console.error("Erreur lors du chargement des données :", error);
        });
};
