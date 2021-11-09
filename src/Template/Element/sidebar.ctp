<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/img/logo.jpg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">El <span class="color-b">Restaurante</span></span>
      
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/empty_profile.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $current_user['NAME'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php 
            if(isset($permitions['Tables'])):
              if(in_array('assignTable', $permitions['Tables']) || in_array('*', $permitions['Tables'])): 
          ?>
                <a href="/admin/tables/assignTable" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Asignar Mesa</p>
                </a> 
          <?php
              endif; 
            endif;
            if(isset($permitions['Products'])):
              if(in_array('index', $permitions['Products']) || in_array('*', $permitions['Products'])): 
          ?>
                <a href="/admin/products" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Productos Base</p>
                </a> 
          <?php
              endif; 
            endif; 
            if(isset($permitions['Products'])):
              if(in_array('providerProducts', $permitions['Products']) || in_array('*', $permitions['Products'])): 
          ?>
                <a href="/admin/products/providerProducts" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Productos Proveedor</p>
                </a> 
          <?php
              endif; 
            endif; 
            if(isset($permitions['Recipes'])):
              if(in_array('index', $permitions['Recipes']) || in_array('*', $permitions['Recipes'])): 
          ?>
                <a href="/admin/recipes/index" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Recetas</p>
                </a> 
          <?php
              endif; 
            endif; 
            if(isset($permitions['ProviderRequest'])):
              if(in_array('index', $permitions['ProviderRequest']) || in_array('*', $permitions['ProviderRequest'])): 
          ?>
                <a href="/admin/providerRequest/index" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Pedidos Proveedores</p>
                </a> 
          <?php
              endif; 
            endif;
            if(isset($permitions['SalesBox'])):
              if(in_array('entries', $permitions['SalesBox']) || in_array('*', $permitions['SalesBox'])): 
          ?>
                <a href="/admin/salesBox/entries" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Ingresos</p>
                </a> 
          <?php
              endif; 
            endif;
            if(isset($permitions['SalesBox'])):
              if(in_array('expenses', $permitions['SalesBox']) || in_array('*', $permitions['SalesBox'])): 
          ?>
                <a href="/admin/salesBox/expenses" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Egresos</p>
                </a> 
          <?php
              endif; 
            endif; 
            if(isset($permitions['SalesBox'])):
              if(in_array('dailyUtility', $permitions['SalesBox']) || in_array('*', $permitions['SalesBox'])): 
          ?>
                <a href="/admin/salesBox/dailyUtility" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Utilidad Diaria</p>
                </a> 
          <?php
              endif; 
            endif; 
            if(isset($permitions['SalesBox'])):
              if(in_array('monthlyUtility', $permitions['SalesBox']) || in_array('*', $permitions['SalesBox'])): 
          ?>
                <a href="/admin/salesBox/monthlyUtility" class="nav-link">
                  <i class="fa fa-circle" aria-hidden="true"></i>
                  <p>Utilidad Mensual</p>
                </a> 
          <?php
              endif; 
            endif; 
         ?>          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Libros
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> 
            <ul class="nav nav-treeview ">
              <li class="nav-item ">
                <a href="/admin/books/index" class="nav-link <?= (strtolower($this->request->params['controller']) == 'books' and strtolower($this->request->params['action']) == 'index') ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/books/add" class="nav-link <?= (strtolower($this->request->params['controller']) == 'books' and strtolower($this->request->params['action']) == 'add') ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Añadir</p>
                </a>
              </li>
            </ul> -->
        </ul>
      </nav>
    </div>
  </aside>