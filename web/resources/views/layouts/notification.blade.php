<div id="notificationArea">
    <ul id="notificationsContainer">
        <li>Chargement...</li>
    </ul>
</div>


</body>

<script>
document.addEventListener("DOMContentLoaded", function () { 
    function fetchNotifications() {
        fetch("{{ route('employees.notifications.get') }}")
            .then(response => response.json())
            .then(data => {
                const notifContainer = document.getElementById("notificationsContainer");
                notifContainer.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(notif => {
                        let notifElement = document.createElement("li");

                        if (notif.FK_account_id_sender) {
                            let notifLink = document.createElement("a");
                            notifLink.href = `/employees/clients/${notif.FK_account_id_sender}`;
                            notifLink.textContent = `${notif.content} (${notif.date})`;

                            // Marquer comme lue avant de rediriger
                            notifLink.addEventListener("click", function (e) {
                                e.preventDefault(); // Empêcher la navigation immédiate
                                markAsSeen(notif.notification_id, notifElement, notif.FK_account_id_sender);
                            });

                            notifElement.appendChild(notifLink);
                        } else {
                            notifElement.textContent = `${notif.content} (${notif.date})`;
                        }

                        let seenButton = document.createElement("button");
                        seenButton.textContent = "Vu";
                        seenButton.classList.add("mark-as-seen");
                        seenButton.dataset.id = notif.notification_id;

                        seenButton.addEventListener("click", function () {
                            markAsSeen(notif.notification_id, notifElement);
                        });

                        notifElement.appendChild(seenButton);
                        notifContainer.appendChild(notifElement);
                    });
                } else {
                    //notifContainer.innerHTML = "<li>Aucune notification</li>";
                }
            })
            .catch(error => console.error("Erreur lors de la récupération des notifications :", error));
    }

    function markAsSeen(notificationId, notifElement, clientId = null) {
        fetch(`/employees/notifications/${notificationId}/markAsSeen`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ seen: true })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            notifElement.style.textDecoration = "line-through"; 

            // Si un clientId est passé, on redirige vers la page du client après avoir marqué comme vu
            if (clientId) {
                window.location.href = `/employees/clients/${clientId}`;
            }
        })
        .catch(error => console.error("Erreur lors de la mise à jour de la notification :", error));
    }

    fetchNotifications();
    setInterval(fetchNotifications, 5000);
});




    </script>
    