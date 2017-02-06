<template>
  <li ref="dropdown" class="dropdown dropdown-notifications">

    <a @click.prevent="toggleDropdown" class="dropdown-toggle" href="#">
      <i :data-count="total" class="fa fa-envelope" :class="{ 'hide-count': !hasUnread }"></i> ({{ total }}) <span class="caret"></span>
    </a>
      <ul class="dropdown-menu">
          <notification v-for="notification in notifications"
                        :notification="notification"
                        v-on:read="markAsRead(notification)"></notification>
          <li v-if="!hasUnread" class="notification">
              Nothing here!
          </li>
          <li v-if="hasUnread" class="dropdown-footer text-center">
              <a href="#" @click.prevent="fetchAll(null)">View All</a>
          </li>
      </ul>
  </li>
</template>

<script>
import $ from 'jquery'
import axios from 'axios'
import Notification from './Notification.vue'
export default {
  components: { Notification },
  data: () => ({

    total: 0,
    notifications: []
  }),
  mounted () {
    this.fetch()
    if (window.Echo) {
      this.listen()
    }
    this.initDropdown()
  },
  computed: {
    hasUnread () {
      return this.total > 0
    }
  },
  methods: {
    /**
     * Fetch notifications.
     *
     * @param {Number} limit
     */
    fetch (limit = 5) {
      axios.get('/notifications', { params: { limit }})
        .then(({ data: { total, notifications }}) => {
          this.total = total
          this.notifications = notifications.map(({ id, data, created }) => {
            return {
              id: id,
              title: data.title,
              body: data.body,
              created: created,
              action_url: data.action_url
            }
          })
        })
    },

    /**
     * Mark the given notification as read.
     *
     * @param {Object} notification
     */
    markAsRead ({ id }) {
      const index = this.notifications.findIndex(n => n.id === id)
      if (index > -1) {
        this.total--
        this.notifications.splice(index, 1)
        axios.patch(`/notifications/${id}/read`)
      }
    },
    /**
     * Mark all notifications as read.
     */
    markAllRead () {
      this.total = 0
      this.notifications = []
      axios.post('/notifications/mark-all-read')
    },
    /**
     * Listen for Echo push notifications.
     */
    listen () {
      window.Echo.private(`App.User.${window.USER.id}`)
        .notification(notification => {
          this.total++
          this.notifications.unshift(notification)
        })
        .listen('NotificationRead', ({ notificationId }) => {
          this.total--
          const index = this.notifications.findIndex(n => n.id === notificationId)
          if (index > -1) {
            this.notifications.splice(index, 1)
          }
        })
        .listen('NotificationReadAll', () => {
          this.total = 0
          this.notifications = []
        })
    },
    /**
     * Initialize the notifications dropdown.
     */
    initDropdown () {
      const dropdown = $(this.$refs.dropdown)
      $(document).on('click', (e) => {
        if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0 &&
          !$(e.target).parent().hasClass('notification-mark-read')) {
          dropdown.removeClass('open')
        }
      })
    },
    /**
     * Toggle the notifications dropdown.
     */
    toggleDropdown () {
      $(this.$refs.dropdown).toggleClass('open')
    }
  }
}
</script>