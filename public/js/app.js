// Edit User
    const roomSelect = document.querySelector('[name="room_id"]');

    const newRoomWrapper =
        document.getElementById('new-room-wrapper');

    roomSelect.addEventListener('change', function () {

        if (this.value === 'new') {

            newRoomWrapper.style.display = 'block';

        } else {

            newRoomWrapper.style.display = 'none';
        }

    });





