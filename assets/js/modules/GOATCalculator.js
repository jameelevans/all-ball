// Utility function: debounce
function debounce(func, wait) {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// GOATCalculator class
class GOATCalculator {
    constructor(formSelector, rankingsSelector) {
        this.form = document.querySelector(formSelector);
        this.rankingsContainer = document.querySelector(rankingsSelector);

        if (this.form && this.rankingsContainer) {
            this.init();
        }
    }

    init() {
        // Debounced input handler
        const debouncedUpdateRankings = debounce(() => this.updateRankings(), 300);

        // Listen to input changes
        this.form.addEventListener("input", debouncedUpdateRankings);
    }

    updateRankings() {
        const formData = new FormData(this.form);

        // Debug: Log form data being sent
        console.log("Form data being sent:");
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        fetch(`${window.location.origin}/wp-admin/admin-ajax.php?action=update_goat_rankings`, {
            method: "POST",
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");
                const updatedRankings = doc.querySelector("#goat-rankings");

                if (updatedRankings) {
                    this.rankingsContainer.innerHTML = updatedRankings.innerHTML;
                } else {
                    console.error("Updated rankings not found in the response.");
                }
            })
            .catch(error => {
                console.error("Error updating rankings:", error);
            });
    }
}

export default GOATCalculator;