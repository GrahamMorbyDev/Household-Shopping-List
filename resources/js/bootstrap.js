// resources/js/bootstrap.js
// Lightweight helper to send completion toggles to the backend.
// Exposes window.toggleItemCompleted(id, isCompleted) which returns a Promise.

(function(){
    window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    window.toggleItemCompleted = function(id, isCompleted){
        // Endpoint follows a conventional RESTish PATCH for updating the item's completed flag.
        // Backend is expected to accept PATCH /shopping-items/{id}/completed with JSON { is_completed: boolean }
        return fetch('/shopping-items/' + encodeURIComponent(id) + '/completed', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ is_completed: !!isCompleted })
        }).then(function(response){
            if (!response.ok) {
                return response.json().then(function(payload){
                    return Promise.reject(payload);
                }).catch(function(){
                    return Promise.reject(new Error('Network response was not ok'));
                });
            }
            return response.json().catch(function(){ return {}; });
        });
    };
})();
