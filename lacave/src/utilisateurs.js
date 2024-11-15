import { useState, useEffect } from "react";

const Utilisateurs = () => {
    class Articles {
        constructor(prenom, nom, matricule) {
            this.prenom = prenom;
            this.nom = nom;
            this.matricule = matricule;
        }
    }

    const createRuptureTab = async () => {
        const ruptureTab = [];
        const response = await fetch('http://localhost:8080/utilisateurs/FindAll');
        const data = await response.json();
        setLenRupture(data.length);
        console.log(data);
        data.forEach((element) => {
            ruptureTab.push(
                new Articles(
                    element.prenom,
                    element.nom,
                    element.matricule
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
    const [formData, setFormData] = useState({ prenom: '', nom: '', matricule: '' });
    const [isEditing, setIsEditing] = useState(false);

    const totalPages = Math.ceil(lenRupture / rowsPerPage);

    useEffect(() => {
        createRuptureTab();
    }, [createRuptureTab]);

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
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const method = isEditing ? 'PUT' : 'POST';
        const url = isEditing ? `http://localhost:8080/utilisateurs/${formData.id}` : 'http://localhost:8080/utilisateurs/create';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        if (response.ok) {
            createRuptureTab();
            setFormData({ prenom: '', nom: '', matricule: '' });
            setIsEditing(false);
        } else {
            console.error('Failed to save utilisateur');
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
                    <h2>Utilisateurs</h2>
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
                            <label>Prénom: </label>
                            <input type="text" name="prenom" value={formData.prenom} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Nom: </label>
                            <input type="text" name="nom" value={formData.nom} onChange={handleChange} required />
                        </div>
                        <div>
                            <label>Matricule: </label>
                            <input type="text" name="matricule" value={formData.matricule} onChange={handleChange} required />
                        </div>
                        <button type="submit">{isEditing ? 'Modifier' : 'Créer'}</button>
                    </form>
                    <table>
                        <thead>
                            <tr>
                                <th onClick={() => requestSort('prenom')}>Prénom</th>
                                <th onClick={() => requestSort('nom')}>Nom</th>
                                <th onClick={() => requestSort('matricule')}>Matricule</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {rupture && rupture.length > 0 && displayPage().map((article, index) => (
                                <tr key={index}>
                                    <td>{article.prenom}</td>
                                    <td>{article.nom}</td>
                                    <td>{article.matricule}</td>
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

export default Utilisateurs;
