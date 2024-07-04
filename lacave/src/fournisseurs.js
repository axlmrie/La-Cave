import { useState, useEffect } from "react";

const Fournisseur = () => {
    class Articles {
        constructor(nom, num, ville, pays) {
            this.num = num;
            this.nom = nom;
            this.ville = ville;
            this.pays = pays;
        }
    }

    const createRuptureTab = async () => {
        const ruptureTab = [];
        const response = await fetch('http://localhost:8080/fournisseurs/FindAll');
        const data = await response.json();
        setLenRupture(data.length);
        console.log(data);
        data.forEach((element) => {
            ruptureTab.push(
                new Articles(
                    element.nom,
                    element.numero_tel,
                    element.adresse.ville,
                    element.adresse.pays
                )
            );
        });
        setRupture(ruptureTab);
    };

    const [rupture, setRupture] = useState([]);
    const [lenRupture, setLenRupture] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const [rowsPerPage, setRowsPerPage] = useState(25);
    const [sortConfig, setSortConfig] = useState({ key: null, direction: 'ascending' });

    // State for form data
    const [formData, setFormData] = useState({ nom: '', num: '', adresse: { idAdresse: '' } });
    const [isEditing, setIsEditing] = useState(false);

    const totalPages = Math.ceil(lenRupture / rowsPerPage);

    useEffect(() => {
        createRuptureTab();
    }, []);

    const displayPage = () => {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        return rupture.slice(start, end);
    };

    const nextPage = () => {
        if (currentPage < totalPages) {
            setCurrentPage(currentPage + 1);
        }
    };

    const prevPage = () => {
        if (currentPage > 1) {
            setCurrentPage(currentPage - 1);
        }
    };

    const handleRowsPerPageChange = (event) => {
        setRowsPerPage(parseInt(event.target.value, 10));
        setCurrentPage(1); // Reset to first page
    };

    const requestSort = (key) => {
        let direction = 'ascending';
        if (sortConfig.key === key && sortConfig.direction === 'ascending') {
            direction = 'descending';
        }
        setSortConfig({ key, direction });
        setRupture((prevRupture) => {
            const sortedRupture = [...prevRupture];
            sortedRupture.sort((a, b) => {
                if (a[key] < b[key]) {
                    return direction === 'ascending' ? -1 : 1;
                }
                if (a[key] > b[key]) {
                    return direction === 'ascending' ? 1 : -1;
                }
                return 0;
            });
            return sortedRupture;
        });
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        const [field, subfield] = name.split('.');
        if (subfield) {
            setFormData({
                ...formData,
                [field]: {
                    ...formData[field],
                    [subfield]: value,
                },
            });
        } else {
            setFormData({
                ...formData,
                [name]: value,
            });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const method = isEditing ? 'PUT' : 'POST';
        const url = isEditing ? `http://localhost:8080/fournisseurs/${formData.id}` : 'http://localhost:8080/fournisseurs/create';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        if (response.ok) {
            createRuptureTab();
            setFormData({ nom: '', num: '', adresse: { idAdresse: '' } });
            setIsEditing(false);
        } else {
            console.error('Failed to save fournisseur');
        }
    };

    const handleEdit = (article) => {
        setFormData(article);
        setIsEditing(true);
    };

    return (
        <>
            <div>
                <div>
                    <h2>Fournisseur</h2>
                    <div>
                        <label htmlFor="rowsPerPage">Lignes par page: </label>
                        <select id="rowsPerPage" value={rowsPerPage} onChange={handleRowsPerPageChange}>
                            <option value={25}>25</option>
                            <option value={50}>50</option>
                            <option value={100}>100</option>
                        </select>
                    </div>
                    <form onSubmit={handleSubmit}>
                        <div>
                            <label>Nom: </label>
                            <input type="text" name="nom" value={formData.nom} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Numéro: </label>
                            <input type="text" name="num" value={formData.num} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Adresse ID: </label>
                            <input type="text" name="adresse.idAdresse" value={formData.adresse.idAdresse} onChange={handleChange} required />
                        </div>
                        <button type="submit">{isEditing ? 'Modifier' : 'Créer'}</button>
                    </form>
                    <table>
                        <thead>
                            <tr>
                                <th onClick={() => requestSort('nom')}>Nom</th>
                                <th onClick={() => requestSort('num')}>Numéro</th>
                                <th onClick={() => requestSort('ville')}>Ville</th>
                                <th onClick={() => requestSort('pays')}>Pays</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {rupture && rupture.length > 0 && displayPage().map((article, index) => (
                                <tr key={index}>
                                    <td>{article.nom}</td>
                                    <td>{article.num}</td>
                                    <td>{article.ville}</td>
                                    <td>{article.pays}</td>
                                    <td>
                                        <button onClick={() => handleEdit(article)}>Modifier</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <div className="pagination">
                        <button onClick={prevPage} disabled={currentPage === 1}>Précédent</button>
                        <span className="pageSur">Page {currentPage} de {totalPages}</span>
                        <button onClick={nextPage} disabled={currentPage === totalPages}>Suivant</button>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Fournisseur;
