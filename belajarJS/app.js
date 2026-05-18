/*
========================================
TICKET MANAGEMENT SYSTEM
Backend / Business Logic
========================================
*/

class Ticket {
  constructor(title, description, priority, createdBy) {
    this.id = crypto.randomUUID();

    this.title = title;
    this.description = description;

    this.priority = priority;

    this.createdBy = createdBy;

    this.assignedTo = null;

    this.status = 'open';

    this.comments = [];

    this.createdAt = new Date();

    this.updatedAt = new Date();
  }
}

class TicketManager {
  constructor() {
    this.tickets = this.loadTickets();
  }

  /*
  ========================================
  STORAGE
  ========================================
  */

  saveTickets() {
    localStorage.setItem(
      'tickets',
      JSON.stringify(this.tickets)
    );
  }

  loadTickets() {
    const data = localStorage.getItem('tickets');

    return data ? JSON.parse(data) : [];
  }

  /*
  ========================================
  CREATE TICKET
  ========================================
  */

  createTicket(title, description, priority, createdBy) {
    if (!title || !description) {
      throw new Error('Title and description required');
    }

    const allowedPriorities = ['low', 'medium', 'high'];

    if (!allowedPriorities.includes(priority)) {
      throw new Error('Invalid priority');
    }

    const ticket = new Ticket(
      title,
      description,
      priority,
      createdBy
    );

    this.tickets.push(ticket);

    this.saveTickets();

    return ticket;
  }

  /*
  ========================================
  GET ALL TICKETS
  ========================================
  */

  getTickets() {
    return this.tickets;
  }

  /*
  ========================================
  GET SINGLE TICKET
  ========================================
  */

  getTicketById(id) {
    return this.tickets.find(
      (ticket) => ticket.id === id
    );
  }

  /*
  ========================================
  UPDATE TICKET
  ========================================
  */

  updateTicket(id, updates) {
    const ticket = this.getTicketById(id);

    if (!ticket) {
      throw new Error('Ticket not found');
    }

    Object.assign(ticket, updates);

    ticket.updatedAt = new Date();

    this.saveTickets();

    return ticket;
  }

  /*
  ========================================
  DELETE TICKET
  ========================================
  */

  deleteTicket(id) {
    const ticketExists = this.getTicketById(id);

    if (!ticketExists) {
      throw new Error('Ticket not found');
    }

    this.tickets = this.tickets.filter(
      (ticket) => ticket.id !== id
    );

    this.saveTickets();

    return true;
  }

  /*
  ========================================
  ASSIGN TICKET
  ========================================
  */

  assignTicket(id, developerName) {
    const ticket = this.getTicketById(id);

    if (!ticket) {
      throw new Error('Ticket not found');
    }

    ticket.assignedTo = developerName;

    ticket.updatedAt = new Date();

    this.saveTickets();

    return ticket;
  }

  /*
  ========================================
  CHANGE STATUS
  ========================================
  */

  changeStatus(id, status) {
    const allowedStatuses = [
      'open',
      'in-progress',
      'testing',
      'closed',
    ];

    if (!allowedStatuses.includes(status)) {
      throw new Error('Invalid status');
    }

    const ticket = this.getTicketById(id);

    if (!ticket) {
      throw new Error('Ticket not found');
    }

    ticket.status = status;

    ticket.updatedAt = new Date();

    this.saveTickets();

    return ticket;
  }

  /*
  ========================================
  ADD COMMENT
  ========================================
  */

  addComment(id, user, message) {
    const ticket = this.getTicketById(id);

    if (!ticket) {
      throw new Error('Ticket not found');
    }

    const comment = {
      id: crypto.randomUUID(),
      user,
      message,
      createdAt: new Date(),
    };

    ticket.comments.push(comment);

    ticket.updatedAt = new Date();

    this.saveTickets();

    return comment;
  }

  /*
  ========================================
  SEARCH TICKETS
  ========================================
  */

  searchTickets(keyword) {
    return this.tickets.filter((ticket) => {
      return (
        ticket.title
          .toLowerCase()
          .includes(keyword.toLowerCase()) ||

        ticket.description
          .toLowerCase()
          .includes(keyword.toLowerCase())
      );
    });
  }

  /*
  ========================================
  FILTER BY STATUS
  ========================================
  */

  filterByStatus(status) {
    return this.tickets.filter(
      (ticket) => ticket.status === status
    );
  }

  /*
  ========================================
  FILTER BY PRIORITY
  ========================================
  */

  filterByPriority(priority) {
    return this.tickets.filter(
      (ticket) => ticket.priority === priority
    );
  }

  /*
  ========================================
  ANALYTICS
  ========================================
  */

  getAnalytics() {
    return {
      totalTickets: this.tickets.length,

      openTickets: this.filterByStatus('open').length,

      inProgressTickets:
        this.filterByStatus('in-progress').length,

      testingTickets:
        this.filterByStatus('testing').length,

      closedTickets:
        this.filterByStatus('closed').length,

      highPriorityTickets:
        this.filterByPriority('high').length,
    };
  }
}

/*
========================================
INITIALIZE SYSTEM
========================================
*/

const system = new TicketManager();

/*
========================================
DEMO TESTING
========================================
*/

try {
  // CREATE
  const ticket1 = system.createTicket(
    'Login bug',
    'User cannot login',
    'high',
    'Doni'
  );

  const ticket2 = system.createTicket(
    'Navbar issue',
    'Navbar overlaps content',
    'medium',
    'Alex'
  );

  // ASSIGN
  system.assignTicket(ticket1.id, 'Frontend Team');

  // CHANGE STATUS
  system.changeStatus(
    ticket1.id,
    'in-progress'
  );

  // COMMENT
  system.addComment(
    ticket1.id,
    'Developer',
    'Bug reproduction successful'
  );

  // UPDATE
  system.updateTicket(ticket2.id, {
    priority: 'high',
  });

  // ANALYTICS
  console.log(
    'Analytics:',
    system.getAnalytics()
  );

  // ALL TICKETS
  console.log(
    'All Tickets:',
    system.getTickets()
  );

  // SEARCH
  console.log(
    'Search:',
    system.searchTickets('login')
  );

} catch (error) {
  console.error(error.message);
}