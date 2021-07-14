<?php
namespace Kubex\Definitions;

class Headers
{
  const WorkspaceID = "x-kx-workspace-id";// Workspace UUID
  const UserID = "x-kx-user-id";// User UID
  const Signature = "x-kx-signature";// Kubex Signature
  const TraceID = "x-kx-trace-id";// Kubex request Trace ID

  const UserIP = "x-kx-user-ip";// User IP
  const UserAgent = "x-kx-user-agent";// User Agent

  const Authorization = "x-kx-authorization";// Json Authorizations, [{"k":"permission-key","e":"A","r":"*"},"k":"permission-key-2","e":"D","r":"uid1"]
  const Authentication = "x-kx-authentication";// JSON access credentials, provided by the app e.g. {"accessToken":"xx"}

}
