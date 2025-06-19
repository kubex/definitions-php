<?php
namespace Kubex\Definitions;

class LaunchMode
{
  public const Page = "page";     // (default) Render in the page
  public const Modal = "modal";    // Launch in a modal
  public const Window = "window";   // Launch in a new window
  public const Slide = "slide";  // Right side overlay app
  public const ActionDrop = "adrop";  // Drop down from the action bar
  public const ActionFill = "afill";  // Fill the action bar with the app
}
